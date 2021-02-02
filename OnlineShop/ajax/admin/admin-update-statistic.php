<?php
session_start();

if ($_SESSION['user'] != 'admin')
	header("Location: ../admin.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';

	$ordersCount = $link->query("SELECT orderID FROM orders");
	$ordersCount = mysqli_num_rows($ordersCount);
	$productsCount = $link->query("SELECT productID FROM products");
	$productsCount = mysqli_num_rows($productsCount);
	$clientsCount = $link->query("SELECT clientID FROM clients");
	$clientsCount = mysqli_num_rows($clientsCount);

echo('
		<li>Всего заказов - <span>'.$ordersCount.'</span></li>
		<li>Товаров - <span>'.$productsCount.'</span></li>
		<li>Клиентов - <span>'.$clientsCount.'</span></li>
');
}