$(document).ready(function() {
	$(".select-sort").click(function() {
		$(".sorting-list").slideToggle(1);
		$(this).toggleClass('select-sort-open');
	});

	$('.burger-span').on('click', function(e) {
		e.preventDefault();
		$(this).toggleClass('burger-span-active');
	});

	$('.card-cart').on('click', function() {
		var id = $(this).attr("pID");
		cartAddProduct(id, 'card');
	});

	$('body').on('click','.btn-minus', function() {
		var id = $(this).attr("pID");
		cartDeleteProduct(id);
	});

	$('body').on('click','.btn-plus', function() {
		var id = $(this).attr("pID");
		cartAddProduct(id, 'cart');
	});

	$('body').on('click','.btn-delete', function() {
		var id = $(this).attr("pID");
		cartDropProduct(id);
	});

	$('body').on('focus','.input-phone', function() {
		$(this).mask("+7 (999) 999-99-99", { });
	});

	$('body').on('click','.form-cart-submit', function(e) {
		$('.form-cart').validate({
				rules: {
					phone : { minlength: 18 },
					local: { minlength: 2 },
					street: { minlength: 2 },
				},
				messages: {
					phone: {
						required: "Это поле необходимо заполнить",
						minlength: "Пожалуйста, укажите номер Вашего мобильного телефона.<br> Например, +7 (999) 999-99-99"
					},
					local: {
						required: "Это поле необходимо заполнить",
						minlength: "Введите больше символов"
					},
					street: {
						required: "Это поле необходимо заполнить",
						minlength: "Введите больше символов" 
					},
					house: {
						required: "Это поле необходимо заполнить",
					},
					name: {
						required: "Это поле необходимо заполнить",
					},
					surname: {
						required: "Это поле необходимо заполнить",
					},
					email: {
						required: "Это поле необходимо заполнить",
						email: "Пожалуйста, введите действительный адрес электронной почты.<br> Например, name@domain.com"
					},
				},
				submitHandler: function() {
					var form_data = $(".form-cart").serialize();
					insertDataBase(form_data);
					e.preventDefault();
				}
		});
	});

	$('body').on('click','.admin-authorization', function(e) {
		$('.form-admin-authorization').validate({
				messages: {
					login: {
						required: "Это поле необходимо заполнить",
					},
					password: {
						required: "Это поле необходимо заполнить",
					}
				},
				submitHandler: function() {
					var data = $(".form-admin-authorization").serialize();
					$.ajax({
				    	async: false,
					    type: 'POST',
					    url: '../ajax/admin/admin-authorization.php',
					    data: data,
					    dataType: "text",
				        success: function(response) {
			        		if (response == "success") {
								$(location).attr('href', 'admin/main.php');
							} else {
								$(".admin-authorization-error").text(response);
								$(".admin-authorization-error").fadeIn('slow');
								setTimeout(function() { $(".admin-authorization-error").fadeOut('slow'); }, 2000);
							}
				        }
			    	});
					e.preventDefault();
				}
		});
	});
});