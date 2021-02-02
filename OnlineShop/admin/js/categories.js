function DeleteCategory(category) {
	$.ajax({
		async: false,
		type: "POST",
		url: "/ajax/admin/admin-delete-category.php",
		data: 'id=' + category,
		dataType: "text",
		success: function(response) {
			if (response == 'success') {
				$(".select-input option:selected").remove();
				$(".delete-category-error").html('<span class="green">Категория удалена!</span>');
				$(".delete-category-error").fadeIn('slow');
				setTimeout(function() { $(".delete-category-error").fadeOut('slow'); }, 2000);
			}
			else {
				$(".delete-category-error").text(response);
				$(".delete-category-error").fadeIn('slow');
				setTimeout(function() { $(".delete-category-error").fadeOut('slow'); }, 2000);
			}
		}
	});
};

function CreateCategory(data) {
	$.ajax({
		async: false,
		type: "POST",
		url: "/ajax/admin/admin-create-category.php",
		data: data,
		dataType: "text",
		success: function(response) {
			if (response == 'success') {
				UpdateCategories();
				$('.clear').val('');
				$(".create-category-error").html('<span class="green">Категория создана!</span>');
				$(".create-category-error").fadeIn('slow');
				setTimeout(function() { $(".create-category-error").fadeOut('slow'); }, 2000);
			} else {
				$(".create-category-error").text(response);
				$(".create-category-error").fadeIn('slow');
				setTimeout(function() { $(".create-category-error").fadeOut('slow'); }, 2000);
			}
		}
	});
};

function UpdateCategories() {
	$.ajax({
		async: false,
		type: "POST",
		url: "/ajax/admin/admin-update-categories.php",
		dataType: "text",
		success: function(response) {
			$('.select-input').html(response);
		}
	});
};