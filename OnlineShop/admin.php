<?php
session_start();
unset($_SESSION['user']);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/style.css">
		<title>Интернет-магазин</title>
	</head>
	<body>
		<div class="container container-center">
			<span class="admin-form-title">Авторизация</span>
				
			<form method="post" class="form-admin-authorization admin-form-container">
				<div class="form-row">
					<label for="login" class="admin-form-label">Логин</label>
					<div class="admin-form-input-container">
						<input class="admin-form-input-text" type="text" maxlength="50" name="login" autocomplete="off" required>
					</div>
				</div>

				<div class="form-row">
					<label for="password" class="admin-form-label">Пароль</label>
					<div class="admin-form-input-container">
						<input class="admin-form-input-text" type="password" name="password" autocomplete="off" required>
					</div>
				</div>

				<div class="form-row">
						<div class="form-submit-container">
							<div class="admin-authorization-error-container">
								<div class="admin-authorization-error error hide"></div>
							</div>
							<input type="submit" class="admin-authorization my-button" value="Войти">
						</div>
				</div>
			</form>
		</div>

		<script type="text/javascript" src="/js/jquery-3.5.1.min.js"></script>
	  	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	    <script type="text/javascript" src="/js/jquery.validate.min.js"></script>
	    <script type="text/javascript" src="/js/script.js"></script>
	</body>
</html>