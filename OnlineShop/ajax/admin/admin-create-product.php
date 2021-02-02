<?php
session_start();

if ($_SESSION['user'] != 'admin')
	header("Location: ../admin.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';

	$title = $_POST['title'];

	$result = $link->query("SELECT * FROM products WHERE productTitle = '$title'");

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

				$link->query("INSERT INTO products (productTitle, productCategory, productMaterial, productPrice, productImage, productDescription, productViews, productVisible) VALUES ('$title','$category','$material','$price','$img', '$description','0','$visible')");
				echo "success";
			} else 
				echo "Файл не является картинкой!";
		} else
			echo "Файл не является картинкой!";
	} else
		echo "Товар с таким названием уже существует!";
}