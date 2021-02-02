<?php
session_start();

if ($_SESSION['user'] != 'admin')
	header("Location: /admin.php");

include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';
include $_SERVER['DOCUMENT_ROOT'].'/functions/functions.php';

$id = clear($_GET['id']);
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
				<?php 
				$rows = $link->query("SELECT * FROM products where productID = $id");
				if (mysqli_num_rows($rows) == 1) {
					$row = mysqli_fetch_array($rows);
					$show_img = base64_encode($row['productImage']);
echo ('
					<span class="admin-form-title">Редактирование товара</span>
					<form method="post" enctype="multipart/form-data" class="form-edit-product admin-form-container">
						<div class="form-row">
							<label for="title" class="admin-form-label">Название</label>
							<div class="admin-form-input-container">
								<input class="admin-form-input-text" type="text" id="title" maxlength="100" name="title" autocomplete="off" required value="'.
								preg_replace('/(?:"([^>]*)")(?!>)/', '«$1»', $row['productTitle']).'">
							</div>
						</div>

						<div class="form-row">
							<label for="type" class="admin-form-label">Тип товара</label>
							<div class="admin-form-input-container">
								<select class="admin-form-input-text select-input" name="type" id="type" size="1" required placeholder>
');
										$rowsCategories = $link->query("SELECT * FROM categories");

										foreach ( $rowsCategories as $rowCategorys )
											if ($rowCategorys['categoryID'] == $row['productCategory'])
												echo '<option value="'.$rowCategorys['categoryID'].'" selected>'.$rowCategorys['categoryName'].'</option>';
											else
												echo '<option value="'.$rowCategorys['categoryID'].'">'.$rowCategorys['categoryName'].'</option>';
echo ('
								</select>
							</div>
						</div>

						<div class="form-row">
							<label for="material" class="admin-form-label">Материал</label>
							<div class="admin-form-input-container">
								<input class="admin-form-input-text" type="text" id="material" maxlength="50" name="material" autocomplete="off" required value="'.$row['productMaterial'].'">
							</div>
						</div>

						<div class="form-row">
							<label for="price" class="admin-form-label">Цена</label>
							<div class="admin-form-input-container">
								<input class="admin-form-input-text" type="number" id="price" name="price" autocomplete="off" required value="'.$row['productPrice'].'">
							</div>
						</div>

						<div class="form-row">
							<label for="description" class="admin-form-label">Описание</label>
							<div class="admin-form-input-container">
								<textarea class="admin-form-input-textarea" id="description" name="description" cols="30" rows="7" required>'.$row['productDescription'].'</textarea>
							</div>
						</div>

						<div class="form-row">
							<label for="visible" class="admin-form-label">Показывать товар</label>
							<div class="admin-form-input-container">
');
							if ($row['productVisible'] == 0)
								echo ('<input class="admin-form-input-checkbox" type="checkbox" id="visible" name="visible">');
							else
								echo ('<input class="admin-form-input-checkbox" type="checkbox" id="visible" name="visible" checked>');
echo ('
							</div>
						</div>

						<div class="form-row row-image">
							<div class="image-container">
								<label class="product-image-label">Картинка</label>
								<div class="change-img">Изменить картинку</div>
								<input type="file" id="image" class="product-image-input hide" name="image" value="Загрузить" required>
							</div>
							
							<div class="product-image">
								<img src="data:image/jpeg;base64,'.$show_img.'">
							</div>
						</div>

						<div class="form-row">
							<label for="type" class="admin-form-label"></label>
							<div class="admin-form-input-container">
								<div class="form-submit-container">
									<div class="edit-product-error-container">
										<div class="edit-product-error error hide"></div>
									</div>
									<input type="submit" class="edit-product my-button" pID="'.$id.'" value="Редактировать">
								</div>
							</div>
						</div>
					</form>
');
				} else
					echo ('<span class="errorMessage">Товар не найден!</span>');
			 	?>
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