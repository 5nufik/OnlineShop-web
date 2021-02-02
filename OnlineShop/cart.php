<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';
include $_SERVER['DOCUMENT_ROOT'].'/functions/functions.php';

$cart = $_SESSION['cart'];
if (count($cart) != 0) {
	foreach ($cart as $id => $count) {
		$row = $link->query("SELECT * FROM products WHERE productID = $id");
		if (mysqli_num_rows($row) == 0)
			unset($cart[$id]);
	}
}
$_SESSION['cart'] = $cart;
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
	    <link rel="stylesheet" href="/fonts/font-awesome/css/all.css">
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/style.css">
		<title>Интернет-магазин</title>
	</head>
	<body>
		<?php include 'include/header.php'; ?>

		<main>
			<div class="container">
				<span class="cart-title">Оформление заказа</span>
<?php
				$cart = $_SESSION['cart'];
				if (count($cart) != 0) {
					foreach ($cart as $id => $count) {
						$row = $link->query("SELECT * FROM products WHERE productID = $id");
						$row = mysqli_fetch_array($row);
						$price += $row["productPrice"] * $count;
					}

					foreach ($cart as $id => $count)
						$cartSizeInfo += $count;

					$cartSizeInfo = strval($cartSizeInfo);

				    if ($cartSizeInfo >= 10 && $cartSizeInfo < 20)
				        $cartSizeInfo .= ' товаров ';
				    else {
				        $checkSize = $cartSizeInfo % 10;
				        if ($checkSize == 1)
				        	$cartSizeInfo .= ' товар ';
				        else if ($checkSize == 0 || $checkSize >= 5 && $checkSize <= 9)
				            $cartSizeInfo .= ' товаров ';
				        else if ($checkSize >= 2 && $checkSize <= 4)
				            $cartSizeInfo .= ' товара ';
				    }
echo ('
					<div class="cart-container">
						<form method="post" class="form-cart">
							<div class="form-row">
								<label for="phone" class="form-cart-label">Телефон</label>
								<div class="form-form-cart-input-container-big">
									<input class="form-cart-input input-phone" type="text" maxlength="18" name="phone" autocomplete="off" value="+7" required>
								</div>
							</div>

							<div class="form-row">
								<label for="local" class="form-cart-label">Населённый пункт</label>
								<div class="form-form-cart-input-container-big">
									<input class="form-cart-input" type="text" maxlength="40" name="local" autocomplete="off" required>
								</div>
							</div>

							<div class="form-row">
								<label for="street" class="form-cart-label">Адрес</label>
								<div class="form-form-cart-input-container-big">
									<input class="form-cart-input" type="text" maxlength="40" name="street" autocomplete="off" placeholder="Улица" required>
								</div>
							</div>

							<div class="form-row">
								<label for="phone" class="form-cart-label"></label>
								<div class="form-form-cart-input-container-big">
									<div class="form-cart-input-small-container">
										<div class="form-cart-input-small">
											<input class="form-cart-input" type="text" maxlength="10" name="house" autocomplete="off" placeholder="Дом" required>
										</div>
										<div class="form-cart-input-small">
											<input class="form-cart-input" type="text" maxlength="10" name="flat" autocomplete="off" placeholder="Квартира">
										</div>
									</div>
								</div>
							</div>

							<div class="form-row">
								<label for="name" class="form-cart-label">Имя</label>
								<div class="form-form-cart-input-container-big">
									<input class="form-cart-input" type="text" maxlength="40" name="name" autocomplete="off" required>
								</div>
							</div>

							<div class="form-row">
								<label for="surname" class="form-cart-label">Фамилия</label>
								<div class="form-form-cart-input-container-big">
									<input class="form-cart-input" type="text" maxlength="40" name="surname" autocomplete="off" required>
								</div>
							</div>

							<div class="form-row">
								<label for="mail" class="form-cart-label">Электронная почта</label>
								<div class="form-form-cart-input-container-big">
									<input class="form-cart-input" type="email" maxlength="50" name="email" autocomplete="off" required>
								</div>
							</div>

							<div class="form-row">
								<label for="comment" class="form-cart-label">Комментарий</label>
								<div class="form-form-cart-input-container-big">
									<textarea class="cart-textarea" name="comment"></textarea>
								</div>
							</div>

							<div class="form-row">
								<div class="form-cart-submit-container">
									<label>Итого:<label class="form-form-cart-submit-price">'.priceValidate($price).'<i class="fas fa-ruble-sign ml-1 fa-sm"></i></label></label>
									<input type="submit" class="form-cart-submit" value="Отправить заказ">
								</div>
							</div>
						</form>

						<div class="cart-info">
							<div class="list-cart-header">
								<div class="cart-product-info"><span class="cartSize">'.$cartSize.'</span></div>
								<div class="cart-product-count"><span>Количество</span></div>
								<div class="cart-product-price"><span>Цена</span></div>
							</div>

							<div class="cart-products-container">
');

						foreach ($cart as $id => $count) {
							$row = $link->query("SELECT * FROM products WHERE productID = $id");

							if (mysqli_num_rows($row) != 0) {

								$row = mysqli_fetch_array($row);

								$show_img = base64_encode($row['productImage']);
								$price = $row["productPrice"] * $count;
echo ('
									<div class="cart-product-card">
										<div class="cart-product-info">
											<div class="cart-product-image"><img src="data:image/jpeg;base64,'.$show_img.'"></div>
											<div class="cart-product-title">'.$row["productTitle"].'</div>
										</div>

										<div class="cart-product-count">
											<div class="btn-minus" pID="'.$row["productID"].'"></div>
											<div class="cart-count">'.$count.'</div>
											<div class="btn-plus" pID="'.$row["productID"].'"></div>
										</div>

										<div class="cart-product-price">
											<span class="cart-price">'.priceValidate($price).'<i class="fas fa-ruble-sign ml-1 fa-sm"></i></span>
											<div class="btn-delete" pID="'.$row["productID"].'">Удалить</div>
										</div>
									</div>
');
							}
						}
echo ('
							</div>
						</div>
');
				} else
echo ('
					<div class="message-container">
						<span class="message-title">В вашей корзине пока нет товаров</span>
						<a href="/catalog.php" class="my-button">Перейти в каталог</a>
					</div>
');
?>
			</div>
		</main>
		
		<?php include 'include/footer.php'; ?>
	    
		<script type="text/javascript" src="/js/jquery-3.5.1.min.js"></script>
	  	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	    <script type="text/javascript" src="/js/jquery.mask.min.js"></script>
	    <script type="text/javascript" src="/js/jquery.validate.min.js"></script>
	    <script type="text/javascript" src="/js/script.js"></script>
	    <script type="text/javascript" src="/js/cart.js"></script>
	</body>
</html>