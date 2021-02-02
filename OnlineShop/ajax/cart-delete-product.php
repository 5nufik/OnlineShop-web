<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	session_start();
	
	$cart = $_SESSION['cart'];

	$id = $_POST['id'];

	if ($cart[$id] > 1)
		$cart[$id]--;
	else
		unset($cart[$id]);

	$_SESSION['cart'] = $cart;
}
?>