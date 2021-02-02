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
				<span class="admin-form-title">Удаление категории</span>
				
				<form method="post" class="form-delete-category admin-form-container">
					<div class="form-row">
						<label for="type" class="admin-form-label">Все категории</label>
						<div class="admin-form-input-container">
							<select class="admin-form-input-select select-input" name="type" id="type" size="10" required>
								<?php
								$rows = $link->query("SELECT * FROM categories");
								foreach ( $rows as $row )
									echo '<option value="'.$row['categoryID'].'">'.$row['categoryName'].'</option>';
								?>
							</select>
						</div>
					</div>

					<div class="form-row">
						<label for="type" class="admin-form-label"></label>
						<div class="admin-form-input-container">
							<div class="form-submit-container">
								<div class="delete-category-error-container error">
									<div class="delete-category-error error hide"></div>
								</div>
								<input type="submit" class="delete-category my-button" value="Удалить">
							</div>
						</div>
					</div>
				</form>

				<span class="admin-form-title">Создание категории</span>

				<form method="post" class="form-create-category admin-form-container">
					<div class="form-row">
						<label for="categoryName" class="admin-form-label">Название</label>
						<div class="admin-form-input-container">
							<input class="admin-form-input-text clear" type="text" id="material" maxlength="50" name="categoryName" autocomplete="off" required>
						</div>
					</div>

					<div class="form-row">
						<label for="material" class="admin-form-label"></label>
						<div class="admin-form-input-container">
							<div class="form-submit-container">
								<div class="create-category-error-container">
									<div class="create-category-error error hide"></div>
								</div>
								<input type="submit" class="create-category my-button" value="Создать">
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
	    <script type="text/javascript" src="/admin/js/categories.js"></script>
	</body>
</html>