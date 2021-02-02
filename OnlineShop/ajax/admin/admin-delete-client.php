<?php
session_start();

if ($_SESSION['user'] != 'admin')
	header("Location: ../admin.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';

	$clientID = $_POST['id'];

	$orderCount = $link->query("SELECT orderID FROM orders WHERE orderClient = $clientID");

	if (mysqli_num_rows($orderCount))
		echo 'Error';
	else
		$link->query("DELETE FROM clients WHERE clientID = '$clientID'");
}