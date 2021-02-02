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
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="/admin/css/style.css">
		<title>Панель управления</title>
	</head>
	<body>
		<?php include 'include/header.php'; ?>
		
		<main>
			<div class="container container-center">
				<span class="admin-form-title">Создание товара</span>
				<form method="post" enctype="multipart/form-data" class="form-create-product admin-form-container">
					<div class="form-row">
						<label for="title" class="admin-form-label">Название</label>
						<div class="admin-form-input-container">
							<input class="admin-form-input-text clear" type="text" id="title" maxlength="100" name="title" autocomplete="off" required>
						</div>
					</div>

					<div class="form-row">
						<label for="type" class="admin-form-label">Тип товара</label>
						<div class="admin-form-input-container">
							<select class="admin-form-input-text select-input clear" name="type" id="type" size="1" required placeholder>
								<option value="" disabled selected>Выберите тип товара</option>
								<?php 
								$rows = $link->query("SELECT * FROM categories");
								foreach ( $rows as $row )
									echo '<option value="'.$row['categoryID'].'">'.$row['categoryName'].'</option>';
								?>
							</select>
						</div>
					</div>

					<div class="form-row">
						<label for="material" class="admin-form-label">Материал</label>
						<div class="admin-form-input-container">
							<input class="admin-form-input-text clear" type="text" id="material" maxlength="50" name="material" autocomplete="off" required>
						</div>
					</div>

					<div class="form-row">
						<label for="price" class="admin-form-label">Цена</label>
						<div class="admin-form-input-container">
							<input class="admin-form-input-text clear" type="number" id="price" name="price" autocomplete="off" required>
						</div>
					</div>

					<div class="form-row">
						<label for="description" class="admin-form-label">Описание</label>
						<div class="admin-form-input-container">
							<textarea class="admin-form-input-textarea clear" id="description" name="description" required></textarea>
						</div>
					</div>

					<div class="form-row">
						<label for="visible" class="admin-form-label">Показывать товар</label>
						<div class="admin-form-input-container">
							<input class="admin-form-input-checkbox check" type="checkbox" id="visible" name="visible" checked>
						</div>
					</div>

					<div class="form-row">
						<label for="image" class="admin-form-label">Картинка</label>
						<div class="admin-form-input-container">
							<input type="file" class="product-image-input clear" name="image" value="Загрузить" required>
						</div>
					</div>

					<div class="form-row">
						<label for="image" class="admin-form-label"></label>
						<div class="admin-form-input-container">
							<div class="form-submit-container">
								<div class="create-product-error-container">
									<div class="create-product-error error hide"></div>
								</div>
								<input type="submit" class="create-product my-button" value="Создать">
							</div>
						</div>
					</div>
				</form>
			</div>
		</main>

		<?php include 'include/footer.php'; ?>

		<script type="text/javascript" src="/js/jquery-3.5.1.min.js"></script>
	  	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	  	<script type="text/javascript" src="/js/jquery.validate.min.js"></script>
	    <script type="text/javascript" src="/admin/js/script.js"></script>
	    <script type="text/javascript" src="/admin/js/products.js"></script>
	</body>
</html>