<?php
	$db_host = 'localhost';
	$db_user = 'mrsnuf54_admin';
	$db_pass = 'Root00';
	$db_database = 'mrsnuf54_admin';

	$link = new mysqli($db_host, $db_user, $db_pass, $db_database);

	if (mysqli_connect_error()) {
	 die('Ошибка подключения (' . mysqli_connect_errno() . ') '
	  . mysqli_connect_error());
	}

	mysqli_set_charset($link, "UTF-8");
?>