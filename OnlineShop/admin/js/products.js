function deleteProduct(id, type) {
	$.ajax({
		async: false,
		type: "POST",
		url: "/ajax/admin/admin-delete-product.php",
		data: 'id=' + id,
		dataType: "text",
		success: function(response) {
			$('.alert').alert();
			updateProductsCount(type);
			$('span[pid='+id+']').closest(".my-card").fadeOut('500', function() {
					$('span[pid='+id+']').closest(".my-card").remove();
				});
		}
	});
};

function updateProductsCount(type) {
	$.ajax({
		async: false,
		type: "POST",
		url: "/ajax/admin/admin-update-products-count.php",
		data: 'type=' + type,
		dataType: "text",
		success: function(response) {
			$('.product-count').html(response);
		}
	});
};

function CreateProduct(data) {
	$.ajax({
		async: false,
		type: "POST",
		url: "/ajax/admin/admin-create-product.php",
		data: data,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "text",
		success: function(response) {
			if (response == "success") {
				$('.clear').val('');
				$('.check').prop('checked', true);
				$(".create-product-error").html('<span class="green">Товар создан!</span>');
				$(".create-product-error").fadeIn('slow');
				setTimeout(function() { $(".create-product-error").fadeOut('slow'); }, 2000);
			}
			else {
				$(".create-product-error").text(response);
				$(".create-product-error").fadeIn('slow');
				setTimeout(function() { $(".create-product-error").fadeOut('slow'); }, 2000);
			}
		}
	});
};

function EditProduct(data) {
	$.ajax({
		async: false,
		type: "POST",
		url: "/ajax/admin/admin-edit-product.php",
		data: data,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "html",
		success: function(response) {
			if (response == "success") {
				$(location).attr('href', '/admin/products.php');
			} else {
				$(".edit-product-error").text(response);
				$(".edit-product-error").fadeIn('slow');
				setTimeout(function() { $(".edit-product-error").fadeOut('slow'); }, 2000);
			}
		}
	});
};