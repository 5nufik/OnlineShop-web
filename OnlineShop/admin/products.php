<?php
session_start();

if ($_SESSION['user'] != 'admin')
	header("Location: /admin.php");

include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
	    <link rel="stylesheet" href="/fonts/font-awesome/css/all.css">
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="/admin/css/style.css">
		<title>Панель управления</title>
	</head>
	<body>
		

		<?php include 'include/header.php'; ?>
			
		<?php include 'include/menu.php'; ?>

		<main>
			<div class="container">
				<?php 
					$rows = mysqli_query($link, "SELECT * FROM products");

					$productCount = mysqli_num_rows($rows);
					echo '<div class="product-count">Всего товаров - '.$productCount.'</div>';
				?>
				<div class="row no-gutters products">
					<?php
						foreach ( $rows as $row ) {
							$show_img = base64_encode($row['productImage']);
							if ($row['productVisible'] == 1)
								$color = green;
							else
								$color = gray;
echo('
							<div class="my-card col-lg-3 col-md-6 col-sm-12">
								<span class="card-title">'.$row["productTitle"].'</span>
								
								<div class="my-card-img">
									<img src="data:image/jpeg;base64,'.$show_img.'">
								</div>
									
								<div class="card-subtitle">
									<a class="card-edit '.$color.'" href="edit-product.php?id='.$row["productID"].'">Редактировать <i class="fas fa-edit"></i></a>
									<span class="card-delete red" pID='.$row["productID"].'>Удалить <i class="fas fa-trash-alt"></i></span>
								</div>
							</div>
');
						}
					?>
				</div>
			</div>
		</main>

		<?php include 'include/footer.php'; ?>
	    
		<script type="text/javascript" src="/js/jquery-3.5.1.min.js"></script>
	  	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	    <script type="text/javascript" src="/admin/js/script.js"></script>
	    <script type="text/javascript" src="/admin/js/products.js"></script>
	</body>
</html>