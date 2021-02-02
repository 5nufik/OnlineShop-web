<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';
include $_SERVER['DOCUMENT_ROOT'].'/functions/functions.php';

$id = $_GET["id"];

$views = $_SESSION['views'];

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

		<?php include 'include/menu.php'; ?>

		<main>
			<div class="container">



<?php

					$row = $link->query("SELECT * FROM products WHERE productID = $id and productVisible = 1");
					if (mysqli_num_rows($row) != 0) {
						$row = mysqli_fetch_array($row);
						$rowCategory = $link->query("SELECT * FROM categories WHERE categoryID = $row[productCategory]");
						$rowCategory = mysqli_fetch_array($rowCategory);
						$show_img = base64_encode($row['productImage']);
echo ('
							<div class="breadcrumbs">
								<span class="breadcrumbs-item"><a href="index.php" class="breadcrumbs-item-link">Главная</a></span>
								<span class="breadcrumbs-item"><a href="catalog.php" class="breadcrumbs-item-link">Каталог</a></span>
								<span class="breadcrumbs-item"><a href="view-categories.php?category='.$rowCategory['categoryID'].'" class="breadcrumbs-item-link">'.$rowCategory['categoryName'].'</a></span>
							</div>

							<div class="view-content">
								<div class="view-img">
									<img src="data:image/jpeg;base64,'.$show_img.'">
								</div>
								<div class="view-body">
									<span class="view-title">'.$row["productTitle"].'</span>
									<span class="view-description">'.str_replace("\n", '<br>', $row[productDescription]).'</span>
									<span class="view-material">Материал: '.$row["productMaterial"].'.</span>	
									<div class="view-cart-add">
										<label class="view-price">'.priceValidate($row["productPrice"]).'<i class="fas fa-ruble-sign ml-1 fa-xs"></i></label>
										<div class="card-cart" pID='.$row["productID"].'><i class="fa fa-shopping-cart mr-2 fa-sm"></i>В корзину</div>
									</div>
								</div>
							</div>
');

						if (!(isset($views[$id]))) {
							$rowViews = $link->query("SELECT productViews FROM products where productID = '$id'");
							$rowViews = mysqli_fetch_array($rowViews);

							$newViews = $rowViews['productViews'] + 1;

							$link->query("UPDATE products set productViews = '$newViews' where productID='$id'");

							$views[$id] = 1; 
							$_SESSION['views'] = $views;
						}
					} else
echo ('
							<div class="message-container">
								<span class="message-title">Товар не найден</span>
								<a href="/catalog.php" class="my-button">Перейти в каталог</a>
							</div>
');
?>
			</div>
		</main>
		
		<?php include 'include/footer.php'; ?>
	    
	    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
	  	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	  	<script type="text/javascript" src="js/script.js"></script>
	  	<script type="text/javascript" src="js/cart.js"></script>
	</body>
</html>