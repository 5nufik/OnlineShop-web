<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	session_start();

	$id = $_POST['id'];

	$cart = $_SESSION['cart'];

	if (isset($cart[$id]))
		$cart[$id]++;
	else
		$cart[$id] = 1; 

	$_SESSION['cart'] = $cart;
}
?>