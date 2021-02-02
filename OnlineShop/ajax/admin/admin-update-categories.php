<?php
session_start();

if ($_SESSION['user'] != 'admin')
	header("Location: ../admin.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';

	$result = $link->query("SELECT * FROM categories");
	$row = mysqli_fetch_array($result);
	do {
		echo '<option value="'.$row['categoryID'].'">'.$row['categoryName'].'</option>';
	} while ($row = mysqli_fetch_array($result));	
}