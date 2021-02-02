<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';
	include $_SERVER['DOCUMENT_ROOT'].'/functions/functions.php';

	session_start();

	$name = clear($_POST['name']);
	$surname = clear($_POST['surname']);
	$email = clear($_POST['email']);
	$phone = clear($_POST['phone']);
	$local = clear($_POST['local']);
	$street = clear($_POST['street']);
	$house = clear($_POST['house']);
	$flat = clear($_POST['flat']);
	$comment = clear($_POST['comment']);

	$address = $local.' '.$street.' '.$house.' '.$flat;

	$orderID = clear($_POST["orderID"]);

	$rows = $link->query("SELECT * FROM products_orders WHERE orderID = $orderID");

	foreach ( $rows as $row ) {
		$products .= $row[productTitle].' ' .$row[productCount].' шт. - '.priceValidate($row[productPrice]).' руб.<br>';
		$totalprice += $row[productPrice];
	}

	include $_SERVER['DOCUMENT_ROOT'].'/phpmailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;
	$mail->CharSet = 'utf-8';
	$mail->isSMTP();									// Set mailer to use SMTP
	$mail->Host = 'smtp.mail.ru';						// Specify main and backup SMTP servers
	$mail->SMTPAuth = true;								// Enable SMTP authentication
	$mail->Username = 'shop.souvenir@mail.ru';			// Логин от почты с которой будут отправляться письма
	$mail->Password = 'qq';						// Пароль от почты с которой будут отправляться письма
	$mail->SMTPSecure = 'ssl';							// Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;									// TCP port to connect
	$mail->setFrom('shop.souvenir@mail.ru');			// от кого будет уходить письмо
	$mail->addAddress('mr.snufik@mail.ru');				// Кому будет уходить письмо 
	$mail->isHTML(true);								// Set email format to HTML
	$mail->Subject = 'Заказ с сайта Souvenir.ru';
	$mail->Body    = ''.$name.' '.$surname.' совершил(а) заказ №'.$orderID.', его(её) телефон '.$phone.'<br>Почта: '.$email.'<br>Адрес: '.$address.'<br><br>Содержимое заказа:<br>'.$products.'<br>Итого: '.priceValidate($totalprice).' руб.<br><br>Комментарий:<br>'.$comment.'<br><br><a href="http://souvenir-shop.nikiforov.fun">souvenir-shop.nikiforov.fun</a>';
	$mail->AltBody = '';
	$mail->send();
}