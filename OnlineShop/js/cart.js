function cartAddProduct(id, click) {
	$.ajax({
		async: false,
		type: "POST",
		url: "/ajax/cart-add-product.php",
		data: 'id=' + id,
		dataType: "text",
		success: function() {
			cartUpdateSize();
			if (click = 'cart')
				cartUpdateProducts();
		}
	});
};

function cartUpdateProducts() {
	$.ajax({
		async: false,
		type: "POST",
		url: "/ajax/cart-update-products.php",
		success: function(response) {
			if (response == "Пусто") {
				$('.cart-container').html(
					'<div class="message-container">' +
						'<span class=message-title>В вашей корзине пока нет товаров</span>' +
						'<a href=/catalog.php class=my-button>Перейти в каталог</a>' +
					'</div>'
				);
				cartUpdateSize();
			}
			else {
				$('.cart-products-container').html(response);
				cartUpdatePrice();
				cartUpdateSize();
			}
		}
	});
};

function cartUpdatePrice() {
	$.ajax({
		async: false,
		type: "POST",
		url: "/ajax/cart-update-price.php",
		success: function(response) {
			$('.form-form-cart-submit-price').html(response);
		}
	});
};

function cartUpdateSize() {
	$.ajax({
		async: false,
		type: "POST",
		url: "/ajax/cart-update-size.php",
		success: function(response) {
			if (response == "Корзина") {
				$('.cartSize').text('');
				$('.cartSizeTitle').text(response);
			} else {
				$('.cartSize').text(response);
				$('.cartSizeTitle').text('в корзине');
			}
		}
	});
};

function cartDropProduct(id) {
	$.ajax({
		async: false,
		type: "POST",
		url: "/ajax/cart-drop-product.php",
		data: 'id=' + id,
		dataType: "text",
		success: function(response) {
			cartUpdateProducts();
		}
	});
};

function cartDeleteProduct(id) {
	$.ajax({
		async: false,
		type: "POST",
		url: "/ajax/cart-delete-product.php",
		data: 'id=' + id,
		dataType: "text",
		success: function() {
			cartUpdateProducts();
		}
	});
};

function insertDataBase(data) {
	$.ajax({
		async: false,
		type: "POST",
		url: "/ajax/insert-database.php",
		data: data,
		dataType: "text",
		success: function(response) {
			if (response != "Error")
				SendMailClient(response, data);
			else
				$('.cart-container').html(
        			'<div class="message-container">' + 
						'<span class="message-title">Произошла ошибка при оформлении заказа</span>' +
						'<a href="/cart.php" class="my-button">Попробовать ещё раз</a>' +
					'</div>'
				);
		}
	});
};

function SendMailClient(orderID, data) {
    $.ajax({
    	async: false,
	    type: 'POST',
	    url: '/ajax/send-mail-client.php',
	    data: 'orderID=' + orderID + '&' + data,
	    dataType: "text",
        success: function(response) {
        	if (response != "Error") {
        		cartUpdateSize();
        		$('.cart-container').html(response);
        		SendMailHost(orderID, data);
        	} else {
        		$('.cart-container').html(
        			'<div class="message-container">' + 
						'<span class="message-title">Произошла ошибка при оформлении заказа</span>' +
						'<a href="/cart.php" class="my-button">Попробовать ещё раз</a>' +
					'</div>'
				);
        		orderCancel(orderID, data);
        	}
        }
    });
};

function SendMailHost(orderID, data) {
    $.ajax({
    	async: false,
	    type: 'POST',
	    url: '/ajax/send-mail-host.php',
	    data: 'orderID=' + orderID + '&' + data,
	    dataType: "text"
	});
};

function orderCancel(orderID, data) {
    $.ajax({
    	async: false,
	    type: 'POST',
	    url: '/ajax/order-cancel.php',
	    data: 'orderID=' + orderID + '&' + data,
	    dataType: "text"
	});
};