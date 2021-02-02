<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';
	include $_SERVER['DOCUMENT_ROOT'].'/functions/functions.php';

	session_start();

	$cart = $_SESSION['cart'];

	foreach ($cart as $id => $count) {
		$row = $link->query("SELECT * FROM `products` WHERE productID = $id");
		$row = mysqli_fetch_array($row);
		$price += $row["productPrice"] * $count;
	}

	echo priceValidate($price).'<i class="fas fa-ruble-sign ml-1 fa-sm"></i>';
}
?>