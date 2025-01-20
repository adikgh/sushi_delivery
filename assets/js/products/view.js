// start jquery
$(document).ready(function() {

	// add product
	$('.view_add_pop').click(function(){
		$('.view_add_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
	})
	$('.view_add_back').click(function(){
		$('.view_add_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})
	$('.view_add').on('click', function() {
		if ($('.views_quantity').attr('data-sel') != 1) {
			if ($('.views_quantity').attr('data-sel') != 1) mess('Введите свой данный')
		} else {
			$.ajax({
				url: "/products/item/view/get.php?view_add",
				type: "POST",
				dataType: "html",
				data: ({
					product: $('.view_add').attr('data-product-id'),
					item: $('.view_add').attr('data-item-id'),
					warehouses: $('.views_warehouses').attr('data-val'),
					quantity: $('.views_quantity').attr('data-val'),
					comment: $('.views_comment').attr('data-val'),
				}),
				success: function(data){
					if (data == 'yes') {
						mess('Успешно')
						setTimeout(function() { location.reload(); }, 500);
					} else mess('Ошибка!'); console.log(data);
				},
				beforeSend: function(){ mess('Отправка..') },
				error: function(data){ mess('Ошибка..') }
			})
		}
	})

	// pitem_btn_delete
	$('.pitem_btn_delete').on('click', function() {
		btn = $(this)
		$.ajax({
			url: "/products/item/view/get.php?pitem_delete",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id'), }),
			success: function(data){
				if (data == 'yes') {
					mess('Успешно')
					setTimeout(function() { location.reload(); }, 500);
				} else mess('Ошибка!'); console.log(data);
			},
			beforeSend: function(){ mess('Отправка..') },
			error: function(data){ mess('Ошибка..') }
		})
	})

	// pitem_minus
	$('.pitem_qn').on('input', function () {
		btn = $(this)
		if (btn.parent().attr('data-quantity') == 0) mess('0');
		else {
			$.ajax({
				url: "/products/item/view/get.php?pitem_qn",
				type: "POST",
				dataType: "html",
				data: ({ 
					quantity: btn.html(),
					id: btn.parent().data('id'),
				}),
				success: function(data){
					if (data == 'yes') mess('Успешно')
					else console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		}
	})
	
	// upd product
	$('.view_upd_pop').click(function(){
		$('.view_upd_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');

		btn = $(this)
		$.ajax({
			url: "/products/item/view/upd_q.php?pitem_d",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id'), }),
			success: function(data){ 
				$('.view_upd_block .pop_bl_cl').html(data);
				$('.fr_number').mask('# ##0', {reverse: true});
				$('.fr_price').mask('# ##0 тг', {reverse: true});
			},
			beforeSend: function(){ },
			error: function(data){ }
		})
	})
	$('.view_upd_back').click(function(){
		$('.view_upd_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
		$('.view_upd_block .pop_bl_cl').html('');
	})	
	$('html').on('click', '.view_upd', function() {
		if ($('.viewu_quantity').val().length >= $('.viewu_quantity').data('length')) {
			if ($('.viewu_quantity').val().length >= $('.viewu_quantity').data('length')) mess('Введите свой данный')
		} else {
			$.ajax({
				url: "/products/item/view/get.php?pitem_upd",
				type: "POST",
				dataType: "html",
				data: ({
					id: $('.view_upd').attr('data-id'),
					warehouses: $('.viewu_warehouses').attr('data-val'),
					quantity: $('.viewu_quantity').attr('data-val'),
					comment: $('.viewu_comment').attr('data-val'),
				}),
				success: function(data){
					if (data == 'yes') {
						mess('Успешно')
						setTimeout(function() { location.reload(); }, 500);
					} else mess('Ошибка!'); console.log(data);
				},
				beforeSend: function(){ mess('Отправка..') },
				error: function(data){ mess('Ошибка..') }
			})
		}
	})














		// pitem_minus
		// $('.pitem_minus').on('click', function () {
		// 	btn = $(this)
		// 	if (btn.parent().attr('data-quantity') == 0) mess('0');
		// 	else {
		// 		$.ajax({
		// 			url: "/products/item/view/get.php?pitem_minus",
		// 			type: "POST",
		// 			dataType: "html",
		// 			data: ({ id: btn.parent().data('id'), }),
		// 			success: function(data){
		// 				if (data == 'yes') {
		// 					quantity = Number(btn.siblings('.uc_uin_calc_q').html()) - 1;
		// 					btn.siblings('.uc_uin_calc_q').html(quantity)
		// 					btn.parent().attr('data-quantity', quantity)
		// 				} else console.log(data);
		// 			},
		// 			beforeSend: function(){ },
		// 			error: function(data){ }
		// 		})
		// 	}
		// })
		// // pitem_plus
		// $('.pitem_plus').on('click', function () {
		// 	btn = $(this)
		// 	$.ajax({
		// 		url: "/products/item/view/get.php?pitem_plus",
		// 		type: "POST",
		// 		dataType: "html",
		// 		data: ({ id: btn.parent().data('id'), }),
		// 		success: function(data){
		// 			if (data == 'yes') {
		// 				quantity = Number(btn.siblings('.uc_uin_calc_q').html()) + 1;
		// 				btn.siblings('.uc_uin_calc_q').html(quantity)
		// 				btn.parent().attr('data-quantity', quantity)
		// 			} else console.log(data);
		// 		},
		// 		beforeSend: function(){ },
		// 		error: function(data){ }
		// 	})
		// })



}) // end jquery