<?php
session_start();

if ($_SESSION['user'] != 'admin')
	header("Location: ../admin.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';

	$type = $_POST['type'];;

	if ($type == "all")
		$typeQuery = '';
	else
		$typeQuery = 'WHERE productCategory = '.$type;

	$rows = $link->query("SELECT * FROM products $typeQuery");

	echo 'Всего товаров - '.mysqli_num_rows($rows);
}