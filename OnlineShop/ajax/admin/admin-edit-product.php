<?php
session_start();

if ($_SESSION['user'] != 'admin')
	header("Location: ../admin.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';

	$id = $_POST['id'];
	$title = $_POST['title'];

	$result = $link->query("SELECT * FROM products WHERE productID != '$id' and productTitle = '$title'");

	if (mysqli_num_rows($result) == 0) {

		$category = $_POST['type'];
		$material = $_POST['material'];
		$price = $_POST['price'];
		$description = $_POST['description'];

		if ($_POST['visible'] == false)
			$visible = 0;
		else 
			$visible = 1;

		if(!empty($_FILES['image']['tmp_name'])) {
			$img_type = substr($_FILES['image']['type'], 0, 5);
			if ($img_type == 'image') {
				$img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
				$set = "productTitle = '$title', productCategory = '$category', productMaterial = '$material', productPrice = '$price', productDescription = '$description', productVisible = '$visible', productImage = '$img'";
			} else {
				echo "Файл не является картинкой!";
				exit;
			}
		} else
			$set = "productTitle = '$title', productCategory = '$category', productMaterial = '$material', productPrice = '$price', productDescription = '$description', productVisible = '$visible'";

		if($link->query("UPDATE products set $set where productID='$id'")) {
			echo "success";
		} else
		echo "Ошибка базы данных!";
} else
	echo "Товар с таким названием уже существует!";
}