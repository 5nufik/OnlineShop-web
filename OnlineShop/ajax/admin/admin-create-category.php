<?php
session_start();

if ($_SESSION['user'] != 'admin')
	header("Location: ../admin.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';

	$categoryName = $_POST["categoryName"];

	$result = $link->query("SELECT * FROM categories WHERE categoryName = '$categoryName'");

	if (mysqli_num_rows($result) == 0) {
		if($link->query("INSERT INTO categories (categoryName) VALUES ('$categoryName')"))
			echo "success";
		else 
			echo "Ошибка базы данных";
	} else
		echo "Такая категория уже существует!";
}