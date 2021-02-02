<?php 
session_start();

include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';
include $_SERVER['DOCUMENT_ROOT'].'/functions/functions.php';

$sorting = clear($_GET["sort"]);

switch ($sorting) {
	case 'price-asc':
		$sorting = 'productPrice ASC';
		$sort_name = 'По возрастанию цены';
		break;
	case 'price-desc':
		$sorting = 'productPrice DESC';
		$sort_name = 'По убыванию цены';
		break;
	case 'default':
		$sorting = 'productViews DESC';
		$sort_name = 'По популярности';
		break;
	default:
		$sorting = 'productViews DESC';
		$sort_name = 'По популярности';
		break;
}
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
				<div class="breadcrumbs">
					<span class="breadcrumbs-item"><a href="index.php" class="breadcrumbs-item-link">Главная</a></span>
					<span class="breadcrumbs-item"><a class="breadcrumbs-item-link">Каталог</a></span>		
				</div>

				<div class="sort">
					<span>Сортировка:</span>
					<span><a class="select-sort"><?php echo $sort_name; ?></a></span>

					<ul class="sorting-list">
						<li><a href="catalog.php?sort=default">По популярности</a></li>
						<li><a href="catalog.php?sort=price-asc">По возрастанию цены</a></li>
						<li><a href="catalog.php?sort=price-desc">По убыванию цены</a></li>
					</ul>
				</div>
			
				<div class="row no-gutters">
<?php
					$rows = $link->query("SELECT * FROM products WHERE productVisible = 1 ORDER BY $sorting");
					
					if (mysqli_num_rows($rows) > 0)
						foreach ( $rows as $row ) {
							$show_img = base64_encode($row['productImage']);
echo ('
					<div class="my-card col-lg-3 col-md-6">
						<div class="my-card-img">
							<img src="data:image/jpeg;base64,'.$show_img.'">
						</div>
						<div class="my-card-body">
							<a class="card-title" href="view-content.php?id='.$row["productID"].'">'.$row["productTitle"].'</a>
							<div class="card-subtitle">
								<span class="card-price">'.priceValidate($row["productPrice"]).'<i class="fas fa-ruble-sign ml-1 fa-xs"></i></span>

								<div class="card-cart" pID='.$row["productID"].'><i class="fa fa-shopping-cart mr-2 fa-sm"></i>В корзину</div>
							</div>
						</div>
					</div>
');
						}
					else
echo ('
					<div class="message-container">
						<span class="message-title">Каталог пуст</span>
					</div>
');
				?>
				</div>
			</div>
		</main>

		<?php include 'include/footer.php'; ?>
	    
	    <script type="text/javascript" src="/js/jquery-3.5.1.min.js"></script>
	  	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	  	<script type="text/javascript" src="/js/script.js"></script>
	  	<script type="text/javascript" src="/js/cart.js"></script>
	</body>
</html>