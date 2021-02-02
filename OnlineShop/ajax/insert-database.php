<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';
	include $_SERVER['DOCUMENT_ROOT'].'/functions/functions.php';

	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$mail = $_POST['email'];
	$phone = $_POST['phone'];

	session_start();

	$cart = $_SESSION['cart'];

	foreach ($cart as $id => $count) {
		$row = $link->query("SELECT * FROM products WHERE productID = $id");

		if (mysqli_num_rows($row) == 0) {
			echo 'Error';
			exit;
		}
	}

	// Добавляем пользователя в базу данных

	$client = $link->query("SELECT clientID FROM clients WHERE clientMail = '$mail'");

	if (mysqli_num_rows($client) == 0) {
		$link->query("INSERT INTO clients (clientName, clientSurname, clientPhone, clientMail) VALUES ('$name','$surname','$phone','$mail')");
		$client = $link->query("SELECT clientID FROM clients WHERE clientMail = '$mail'");
	}
	else
		$link->query("UPDATE clients set clientName = '$name', clientSurname = '$surname', clientPhone = '$phone' where clientMail = '$mail'");

	// Создаём заказ в базе данных

	$client = mysqli_fetch_array($client);

	$clientID = $client['clientID'];
	$date = date("Y-m-d H:i:s");
	$hash = md5($date);

	$local = $_POST['local'];
	$street = $_POST['street'];
	$house = $_POST['house'];
	$flat = $_POST['flat'];
	$comment = $_POST['comment'];

	$address = $local.' '.$street.' '.$house.' '.$flat;

	$order = $link->query("INSERT INTO orders (orderClient, orderDate, orderAddress, orderComment, orderHash) VALUES ('$clientID','$date','$address','$comment', '$hash')");

	// Получаем номер заказа

	$orderID = $link->query("SELECT orderID FROM orders WHERE orderHash = '$hash'");
	$orderID = mysqli_fetch_array($orderID);
	$orderID = $orderID['orderID'];

	// Добавляем продукты к заказу в базе данных

	$order = $link->query("INSERT INTO products_orders (orderClient, orderDate, orderAddress, orderComment, orderHash) VALUES ('$clientID','$date','$address','$comment', '$hash')");

	

	foreach ($cart as $id => $count) {
		$row = $link->query("SELECT * FROM products WHERE productID = $id");
		$row = mysqli_fetch_array($row);
		
		$price = $row["productPrice"] * $count;

		$link->query("INSERT INTO products_orders (orderID, productTitle, productCount, productPrice) VALUES ('$orderID','$row[productTitle]','$count','$price')");
	}

	echo $orderID;
}