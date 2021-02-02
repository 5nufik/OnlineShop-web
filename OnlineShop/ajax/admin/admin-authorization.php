<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';

$login = $_POST['login'];
$password = $_POST['password'];

$result = $link->query("SELECT * FROM admins WHERE adminLogin = '$login'");

if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_array($result);
	if (password_verify($password, $row['adminPassword'])) {
		$_SESSION['user'] = 'admin';
		echo 'success';
	} else
		echo 'Неверный логин или пароль!';
} else
	echo 'Неверный логин или пароль!';