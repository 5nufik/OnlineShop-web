$(document).ready(function() {
	
	$("body").on("click", ".orders-clients-menu-item", function() {
		$(".orders-clients-menu").find(".menu-active").removeClass("menu-active");
		$(this).addClass("menu-active");
		if ($(this).index() == $(".orders").index()) {
			$(".clients").fadeOut(250, function() {
					$(".orders").fadeIn(250);
			});
		}
		if ($(this).index() == $(".clients").index()) {
			$(".orders").fadeOut(250, function() {
					$(".clients").fadeIn(250);
			});
		}
	});

	$("body").on("click", ".order-delete", function() {
		var id = $(this).attr("oID");
		deleteOrder(id);
		$('span[oid='+id+']').parent().fadeOut('500', function() {
				$('span[oid='+id+']').parent().remove();
			});
	});

	$("body").on("click", ".delete-order", function() {
		var id = $(this).attr("oID");
		deleteOrder(id);
	});

	$("body").on("click", ".client-delete", function() {
		var id = $(this).attr("cID");
		deleteClient(id);
	});	
	
	$("body").on("click", ".client-main", function() {
		$(this).parent().find('.client-info').slideToggle(300);
	});

	$('body').on('click','.card-delete', function() {
		var id = $(this).attr("pID");
		deleteProduct(id, 'all');
	});

	$('body').on('click','.card-delete-categories', function() {
		var id = $(this).attr("pID");
		var type = $(this).attr("pTYPE");
		deleteProduct(id, type);
	});

	$('body').on('click','.delete-category', function(e) {
		$('.form-delete-category').validate({
			messages: {
				type: {
					required: "Необходимо выбрать категорию",
				},
			},
			submitHandler: function() {
				var category = $(".select-input option:selected").val();
				DeleteCategory(category);
				e.preventDefault();
			}
		});
	});

	$('body').on('click','.create-category', function(e) {
		$('.form-create-category').validate({
			messages: {
				categoryName: {
					required: "Это поле необходимо заполнить",
				}
			},
			submitHandler: function() {
				var form_data = $(".form-create-category").serialize();
				CreateCategory(form_data);
				e.preventDefault();
			}
		});			
	});

	$('body').on('click','.create-product', function(e) {
		$('.form-create-product').validate({
				messages: {
					title: {
						required: "Это поле необходимо заполнить",
					},
					type: {
						required: "Необходимо выбрать тип товара",
					},
					material: {
						required: "Это поле необходимо заполнить",
					},
					price: {
						required: "Это поле необходимо заполнить",
						number: "Цена состоит из чисел",
					},
					description: {
						required: "Это поле необходимо заполнить",
					},
					image: {
						required: "Необходимо загрузить картинку",
					},
				},
				submitHandler: function() {
					var data = new FormData($('.form-create-product')[0]);
					CreateProduct(data);
					e.preventDefault();
				}
		});			
	});

	$('body').on('click','.edit-product', function(e) {
		$('.form-edit-product').validate({
			messages: {
				title: {
					required: "Это поле необходимо заполнить",
				},
				type: {
					required: "Необходимо выбрать тип товара",
				},
				material: {
					required: "Это поле необходимо заполнить",
				},
				price: {
					required: "Это поле необходимо заполнить",
					number: "Цена состоит из чисел",
				},
				description: {
						required: "Это поле необходимо заполнить",
				},
				image: {
					required: "Необходимо загрузить картинку",
				}
			},
			submitHandler: function() {
				var id = $('.edit-product').attr("pID");
				var data = new FormData($('.form-edit-product')[0]);
				data.append('id', id);
				EditProduct(data);
				e.preventDefault();
			}
		});
	});

	$('.change-img').on('click', function() {
		$(".change-img").hide('slow');
		$(".product-image").hide('slow');
		$(".product-image-input").show('slow');
	});
});