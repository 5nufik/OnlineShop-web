<?php
session_start();

if ($_SESSION['user'] != 'admin')
	header("Location: /admin.php");

include $_SERVER['DOCUMENT_ROOT'].'/functions/dbHandler.php';

$ordersCount = $link->query("SELECT orderID FROM orders");
$ordersCount = mysqli_num_rows($ordersCount);
$productsCount = $link->query("SELECT productID FROM products");
$productsCount = mysqli_num_rows($productsCount);
$clientsCount = $link->query("SELECT clientID FROM clients");
$clientsCount = mysqli_num_rows($clientsCount);
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
		<?php include 'include/header.php' ?>

		<div class="container container-center">
			<span class="admin-form-title">Общая статистика</span>
			<ul class="statistics">
				<li>Всего заказов - <span><?php echo $ordersCount; ?></span></li>
				<li>Товаров - <span><?php echo $productsCount; ?></span></li>
				<li>Клиентов - <span><?php echo $clientsCount; ?></span></li>
			</ul>

			<ul class="orders-clients-menu">
				<li class="orders-clients-menu-item menu-active">Заказы</li>
				<li class="orders-clients-menu-item">Клиенты</li>
			</ul>
			
			<div class="orders-clients-container">
				<div class="orders">

<?php
						$rows = $link->query("SELECT * FROM orders order by orderID desc");
						if (mysqli_num_rows($rows) != 0) {
							foreach ( $rows as $row ) {
	echo ('
							<div class="order-row">
								<span class="order-number">№ '.$row[orderID].'</span>
								<span class="order-date">'.$row[orderDate].'</span>
								<a href="view-order.php?id='.$row[orderID].'" class="order-delete blue"><i class="fas fa-info-circle fa-lg"></i></a>
								<span class="order-delete red a" oID="'.$row[orderID].'"><i class="fas fa-minus-circle fa-lg"></i></span>
							</div>
	');
							}
						}
	?>
				</div>

				<div class="clients hide">
<?php
						$rowClients = $link->query("SELECT * FROM clients order by clientID desc");
						if (mysqli_num_rows($rowClients) != 0) {
							foreach ( $rowClients as $rowClient ) {
	echo ('
							<div class="client-row">
								<div class="client-main">
									<span class="client-fio">'.$rowClient[clientName].' '.$rowClient[clientSurname].'</span>
									<span class="client-phone">'.$rowClient[clientPhone].'</span>
									<span class="client-mail">'.$rowClient[clientMail].'</span>
									<span class="client-delete red a" cID="'.$rowClient[clientID].'"><i class="fas fa-user-slash"></i></span>
								</div>

								<div class="client-info hide">
									<ul>
');
									$rowOrders = $link->query("SELECT * FROM orders where orderClient = $rowClient[clientID] order by orderID desc");
										if (mysqli_num_rows($rowOrders) != 0) {
											foreach ( $rowOrders as $rowOrder ) {
												echo '<li>
												<span><a href="view-order.php?id='.$rowOrder[orderID].'">Заказ №'.$rowOrder[orderID].'</a> от '.$rowOrder[orderDate].'</span>
												<span class="order-delete red a" oID="'.$rowOrder[orderID].'"><i class="fas fa-minus-circle fa-lg"></i></span>
												
												</li>';
											}
										}
echo ('
									</ul>
								</div>
							</div>
');
							}
						}
?>
				</div>
			</div>
		</div>

		<?php include 'include/footer.php'; ?>

		<script type="text/javascript" src="/js/jquery-3.5.1.min.js"></script>
	  	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	    <script type="text/javascript" src="/admin/js/script.js"></script>
	    <script type="text/javascript" src="/admin/js/statistic.js"></script>
	</body>
</html>