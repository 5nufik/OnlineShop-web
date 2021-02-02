<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	session_start();
		$cart = $_SESSION['cart'];

		if (count($cart) > 0) {
			foreach ($cart as $id => $count) {
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
		} else
			$cartSize = 'Корзина';

	echo $cartSize;
}
?>