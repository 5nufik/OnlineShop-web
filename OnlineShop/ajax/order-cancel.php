<?php
session_start();

if ($_SESSION['user'] != 'admin')
	header("Location: ../admin.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';

	$orderID = $_POST['orderID'];
	$email = $_POST['email'];

	$link->query("DELETE FROM products_orders WHERE orderID = '$orderID'");

	$link->query("DELETE FROM orders WHERE orderID = '$orderID'");

	$link->query("DELETE FROM clients WHERE clientMail = '$email'");
}