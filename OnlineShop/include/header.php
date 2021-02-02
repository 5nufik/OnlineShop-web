<?php
$cart = $_SESSION['cart'];

if (count($cart) > 0) {
	foreach ($cart as $product => $count) {
		$cartSize += $count;
	}

	$cartSize = strval($cartSize);

    if ($cartSize >= 10 && $cartSize < 20)
        $cartSize .= ' товаров ';
    else {
        $checkSize = $cartSize % 10;
        if ($checkSize == 1)
        	$cartSize .= ' товар ';
        else if ($checkSize == 0 || $checkSize >= 5 && $checkSize <= 9)
             $cartSize .= ' товаров ';
        else if ($checkSize >= 2 && $checkSize <= 4)
             $cartSize .= ' товара ';
    }
    $cartSizeTitle = 'в корзине';
} else {
	$cartSize = '';
	$cartSizeTitle = 'Корзина';
}
?>

<div class="content">
<header>
	<nav class="navbar fixed-top navbar-expand-lg main-nav">
		<div class="container">
			<a class="navbar-brand waves-effect">
				<span class="blue-text">SVNR</span>
			</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toogle navigation">
				<div class="menu-bar"><i class="fas fa-bars"></i></div>
			</button>

			<div class="collapse navbar-collapse" id="navbarContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a href="index.php" class="nav-link">Главная</a>
					</li>
					<li class="nav-item">
						<a href="catalog.php" class="nav-link">Каталог</a>
					</li>
				</ul>

				<ul class="navbar-nav">
					<li class="nav-item">
						<a href="cart.php" class="nav-link">
							<i class="fa fa-shopping-cart mr-2 fa-sm"></i>
							<span class="cartSize">
								<?php echo $cartSize; ?>
							</span>
							<span class="cartSizeTitle">
								<?php echo $cartSizeTitle; ?>
							</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>