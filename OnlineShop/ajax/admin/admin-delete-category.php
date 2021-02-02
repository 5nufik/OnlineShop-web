<?php
session_start();

if ($_SESSION['user'] != 'admin')
	header("Location: ../admin.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';

	$id = $_POST["id"];

	if($link->query("DELETE FROM categories WHERE categoryID = '$id'")) {
		echo "success";
	} else {
		echo "В этой категории содержатся товары!";
	}
}