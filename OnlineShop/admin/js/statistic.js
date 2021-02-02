function deleteOrder(id) {
	$.ajax({
		async: false,
		type: "POST",
		url: "/ajax/admin/admin-delete-order.php",
		data: 'id=' + id,
		dataType: "text",
		success: function(response) {
			updateStatistic();
		}
	});
};

function deleteClient(id) {
	$.ajax({
		async: false,
		type: "POST",
		url: "/ajax/admin/admin-delete-client.php",
		data: 'id=' + id,
		dataType: "text",
		success: function(response) {
			if (response != "Error") {
				updateStatistic();
				$('span[cid='+id+']').closest(".client-row").fadeOut('500', function() {
					$('span[cid='+id+']').closest(".client-row").remove();
				});
			}
		}
	});
};

function updateStatistic() {
	$.ajax({
		async: false,
		type: "POST",
		url: "/ajax/admin/admin-update-statistic.php",
		success: function(response) {
			$('.statistics').html(response);
		}
	});
};