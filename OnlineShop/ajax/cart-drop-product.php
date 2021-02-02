<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	session_start();

	$id = $_POST['id'];

	$cart = $_SESSION['cart'];

	unset($cart[$id]);

	$_SESSION['cart'] = $cart;
}
?>