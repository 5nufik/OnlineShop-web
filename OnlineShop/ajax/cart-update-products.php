<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';
	include $_SERVER['DOCUMENT_ROOT'].'/functions/functions.php';

	session_start();
	$cart = $_SESSION['cart'];

			if (count($cart) != 0) {

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
					} else {
						unset($cart[$id]);
						if (count($cart) == 0)
							echo 'Пусто';
						$_SESSION['cart'] = $cart;
					}
				}
			} else
				echo 'Пусто';
}
?>