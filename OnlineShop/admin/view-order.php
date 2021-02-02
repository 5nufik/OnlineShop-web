<?php
session_start();

if ($_SESSION['user'] != 'admin') {
	header("Location: /admin.php");
}

include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';
include $_SERVER['DOCUMENT_ROOT'].'/functions/functions.php';

$id = clear($_GET["id"]);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
	    <link rel="stylesheet" href="/fonts/font-awesome/css/all.css">
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="/admin/css/style.css">
		<title>Панель управления</title>
	</head>
	<body>
		<?php include 'include/header.php'; ?>

		<main>
			<div class="container container-center">
				<?php 
					$rows = mysqli_query($link, "SELECT * FROM products_orders WHERE orderID = $id");
					if (mysqli_num_rows($rows) != 0) {
echo ('
						<span class="admin-form-title">Заказ №'.$id.'</span>
						<table class="table-products-container">
							<tr>
								<th>№</th>
								<th>Наименование товара</th>
								<th>Количество</th>
								<th>Цена</th>
							</tr>
');
						$number = 1;
						foreach ($rows as $row) {
							$finalPrice += $row[productPrice];
							
echo ('
							<tr>
								<td>'.$number.'</td>
								<td>'.$row[productTitle].'</td>
								<td>'.$row[productCount].'</td>
								<td>'.priceValidate($row[productPrice]).' руб</td>
							</tr>
');
							$number += 1;
						}
echo ('
							<tr>
								<td colspan="3" style="text-align:right; font-weight: bold;" class="pr-2">Итого: </td>
								<td style="font-weight: bold;">'.priceValidate($finalPrice).' руб</td>
							</tr>
						</table>
');

						$rowOrder = mysqli_query($link, "SELECT * FROM orders WHERE orderID = $id");
						$rowOrder = mysqli_fetch_array($rowOrder);
						$rowClient = mysqli_query($link, "SELECT * FROM clients WHERE clientID = $rowOrder[orderClient]");
						$rowClient = mysqli_fetch_array($rowClient);
echo ('
						<table class="table-info-container">
							<tr>
								<th class="fio">ФИО</th>
								<th class="address">Адрес</th>
								<th class="contacts">Контакты</th>
								<th class="comment">Комментарий</th>
							</tr>
');
echo ('
							<tr>
								<td class="fio align-items-center">'.$rowClient[clientName].' '.$rowClient[clientSurname].'</td>
								<td class="address">'.$rowOrder[orderAddress].'</td>
								<td class="contacts">'.$rowClient[clientPhone].'<br>'.$rowClient[clientMail].'</td>
								<td class="comment">'.$rowOrder[orderComment].'</td>
							</tr>
						</table>
');

echo ('
						<a href="/admin/main.php" class="delete-order my-button" oID='.$row[orderID].'>Удалить</a>
');
					}
					
				?>
			</div>
		</main>
		
		<?php include 'include/footer.php'; ?>
	    
		<script type="text/javascript" src="/js/jquery-3.5.1.min.js"></script>
	  	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	    <script type="text/javascript" src="/admin/js/script.js"></script>
	    <script type="text/javascript" src="/admin/js/statistic.js"></script>
	</body>
</html>