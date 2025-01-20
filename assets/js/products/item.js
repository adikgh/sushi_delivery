// start jquery
$(document).ready(function() {



	// upd product
	$('.pr_upd_pop').click(function(){
		$('.pr_upd_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
		btn = $(this)
		$.ajax({
			url: "/products/item/upd_item.php?upd",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id'), }),
			success: function(data){
				$('.pr_upd_block .pop_bl_cl').html(data);
			},
			beforeSend: function(){ },
			error: function(data){ }
		})
	})
	$('.pr_upd_back').click(function(){
		$('.pr_upd_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
		$('.pr_upd_block .pop_bl_cl').html('');
	})
	$('html').on('click', '.pr_upd', function() {
		if ($('.pr_upd_name').val().length >= $('.pr_upd_name').data('length')) {
			if ($('.pr_upd_name').val().length >= $('.pr_upd_name').data('length')) mess('Введите свой данный')
		} else {
			$.ajax({
				url: "/products/item/get.php?pr_upd",
				type: "POST",
				dataType: "html",
				data: ({
					id: $('.pr_upd').data('id'),
					name: $('.pr_upd_name').attr('data-val'), catalog: $('.pr_upd_catalog').attr('data-val'),
					brand: $('.pr_upd_brand').attr('data-val'), country: $('.pr_upd_country').attr('data-val'),
					collection: $('.pr_upd_collection').attr('data-val'), style: $('.pr_upd_style').attr('data-val'), 
				}),
				success: function(data){
					if (data == 'yes') {
						mess('Успешно')
						setTimeout(function() { location.reload(); }, 500);
					} else mess('Ошибка!'); console.log(data);
				},
				beforeSend: function(){ mess('Отправка..') },
				error: function(data){ }
			})
		}
	})


	// delete
	$('html').on('click', '.pr_delete', function() {
		btn = $(this)
		$.ajax({
			url: "/products/get.php?product_delete",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id'), }),
			success: function(data){
				if (data == 'yes') {
					mess('Успешно')
					setTimeout(function() { location.reload(); }, 500);
				} else mess('Ошибка!'); console.log(data);
			},
			beforeSend: function(){ },
			error: function(data){ }
		})
	})



	// add product
	$('.pitem_add_pop').click(function(){
		$('.pitem_add_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
	})
	$('.pitem_add_back').click(function(){
		$('.pitem_add_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})
	$('.pitem_img_add').click(function(){ $(this).siblings('.pitem_img').click() })
	$('.pitem_add').on('click', function() {
		if ($('.pitem_article').attr('data-sel') != 1) {
			if ($('.pitem_article').attr('data-sel') != 1) mess('Введите свой данный')
		} else {
			$.ajax({
				url: "/products/item/get.php?pitem_add",
				type: "POST",
				dataType: "html",
				data: ({
					article: $('.pitem_article').attr('data-val'), barcode: $('.pitem_barcode').attr('data-val'),
					quantity: $('.pitem_quantity').attr('data-val'), price: $('.pitem_price').attr('data-val'),
					purchase_price: $('.pitem_purchase_price').attr('data-val'), discount_price: $('.pitem_discount_price').attr('data-val'),
					img: $('.pitem_img').attr('data-val'), id: $('.pitem_add').data('id'),
					color: $('.pitem_color').attr('data-val'), size: $('.pitem_size').attr('data-val'),
					warehouses: $('.pitem_warehouses').attr('data-val'),
				}),
				success: function(data){
					if (data == 'yes') {
						mess('Успешно')
						setTimeout(function() { location.reload(); }, 500);
					} else mess('Ошибка!'); console.log(data);
				},
				beforeSend: function(){ mess('Отправка..') },
				error: function(data){ }
			})
		}
	})

	// pitem_btn_delete
	$('.pitem_btn_delete').on('click', function() {
		btn = $(this)
		$.ajax({
			url: "/products/item/get.php?pitem_delete",
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
			error: function(data){ }
		})
	})

	// upd item
	$('.pitem_upd_pop').click(function(){
		$('.pitem_upd_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
		btn = $(this)
		$.ajax({
			url: "/products/item/view/upd_view.php?pitem_d",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id'), }),
			success: function(data){ 
				$('.pitem_upd_block .pop_bl_cl').html(data);
				$('.fr_number').mask('# ##0', {reverse: true});
				$('.fr_price').mask('# ##0 тг', {reverse: true});
			},
			beforeSend: function(){ },
			error: function(data){ }
		})
	})
	$('.pitem_upd_back').click(function(){
		$('.pitem_upd_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
		$('.pitem_upd_block .pop_bl_cl').html('');
	})

	$('html').on('click', '.pitem_img_upd_btn', function(){ $(this).siblings('.pitem_img_upd').click() })
	$('html').on('click', '.pitem_img_upd_btn2', function(){ $(this).siblings('.pitem_img_upd2').click() })

	$('html').on('click', '.pitem_upd', function() {
		if ($('.pitem_article_upd').val().length >= $('.pitem_article_upd').data('length') || $('.pitem_price_upd').val().length >= $('.pitem_price_upd').data('length')) {
			if ($('.pitem_article_upd').val().length >= $('.pitem_article_upd').data('length')) mess('Введите свой данный')
			if ($('.pitem_price_upd').val().length >= $('.pitem_price_upd').data('length')) mess('Введите свой данный')
		} else {
			$.ajax({
				url: "/products/item/get.php?pitem_upd",
				type: "POST",
				dataType: "html",
				data: ({
					article: $('.pitem_article_upd').attr('data-val'), barcode: $('.pitem_barcode_upd').attr('data-val'),
					quantity: $('.pitem_quantity_upd').attr('data-val'), price: $('.pitem_price_upd').attr('data-val'),
					purchase_price: $('.pitem_purchase_price_upd').attr('data-val'), discount_price: $('.pitem_discount_price_upd').attr('data-val'),
					color: $('.pitem_color_upd').attr('data-val'), size: $('.pitem_size_upd').attr('data-val'),
					img: $('.pitem_img_upd').attr('data-val'), img2: $('.pitem_img_upd2').attr('data-val'),
					id: $('.pitem_upd').data('id'),
				}),
				success: function(data){
					if (data == 'yes') {
						mess('Успешно')
						setTimeout(function() { location.reload(); }, 500);
					} else mess('Ошибка!'); console.log(data);
				},
				beforeSend: function(){ mess('Отправка..') },
				error: function(data){ }
			})
		}
	})



	// item price update
	$('html').on('input', '.item_upd_pr', function () {
		btn = $(this)
		if (btn.attr('data-sel') != 1) mess('Введите свой данный')
		else {
			$.ajax({
				url: "/products/item/view/get.php?item_price_upd",
				type: "POST",
				dataType: "html",
				data: ({ 
					id: btn.data('id'),
					price: btn.attr('data-val'),
				}),
				success: function(data){
					console.log(data);
					console.log(btn.attr('data-val'));
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		}
	})







	// view quantity update
	$('html').on('click', '.pitem_updq_pop', function() {
		$('.pitem_updq_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
		btn = $(this)
		$.ajax({
			url: "/products/item/view/upd_qs.php?pitem_d",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id'), }),
			success: function(data){ 
				$('.pitem_updq_block .pop_bl_cl').html(data);
				$('.fr_number').mask('# ##0', {reverse: true});
				$('.fr_number2').mask('#0', {reverse: true});
			},
			beforeSend: function(){ },
			error: function(data){ }
		})
	})
	$('html').on('click', '.pitem_updq_back', function() {
		$('.pitem_updq_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
		$('.pitem_updq_block .pop_bl_cl').html('');
		if ($('.pitem_updq_block').attr('data-load') == 1) location.reload();	
	})
	$('html').on('input', '.view_updq_qn', function () {
		btn = $(this)
		if (btn.attr('data-sel') != 1) mess('Введите свой данный')
		else {
			$.ajax({
				url: "/products/item/view/get.php?pitem_qn",
				type: "POST",
				dataType: "html",
				data: ({ 
					quantity: btn.attr('data-val'),
					id: btn.data('id'),
				}),
				beforeSend: function(){ },
				error: function(data){ },
				success: function(data){
					$('.pitem_updq_block').attr('data-load', 1)
					console.log(data);
					console.log(btn.attr('data-val'));
				},
			})
		}
	})


	// add quent
	$('html').on('click', '.view_add_pop', function(){
		$('.view_add_block').addClass('pop_bl_act')
		$('#html').addClass('ovr_h')
		$('.view_add_block .view_add').attr('data-item-id', $(this).attr('data-id'))
	})
	$('html').on('click', '.view_add_back', function(){ $('.view_add_block').removeClass('pop_bl_act'); })
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
						upd_qs($('.view_add').attr('data-item-id'));
					} else mess('Ошибка!'); console.log(data);
				},
				beforeSend: function(){ mess('Отправка..') },
				error: function(data){ mess('Ошибка..') }
			})
		}
	})
	$('html').on('click', '.pitem_btn_delete', function() {
		btn = $(this)
		$.ajax({
			url: "/products/item/view/get.php?pitem_delete",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id'), }),
			success: function(data){
				if (data == 'yes') {
					mess('Успешно')
					upd_qs(btn.attr('data-item-id'));
				} else mess('Ошибка!'); console.log(data);
			},
			beforeSend: function(){ mess('Отправка..') },
			error: function(data){ mess('Ошибка..') }
		})
	})

	function upd_qs(item) {
		$.ajax({
			url: "/products/item/view/upd_qs.php?pitem_d",
			type: "POST",
			dataType: "html",
			data: ({ id: item }),
			success: function(data){ 
				$('.pitem_updq_block .pop_bl_cl').html(data);
				$('.fr_number').mask('# ##0', {reverse: true});
				$('.fr_number2').mask('#0', {reverse: true});
			},
			beforeSend: function(){
				$('.view_add_block').removeClass('pop_bl_act');
				$('.pitem_updq_block').attr('data-load', 1)
			},
			error: function(data){ }
		})
	}












	

	// pitem_minus
	// $('.pitem_minus').on('click', function () {
	// 	btn = $(this)
	// 	if (btn.parent().attr('data-quantity') == 0) mess('0');
	// 	else {
	// 		$.ajax({
	// 			url: "/admin/products/item/get.php?pitem_minus",
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
	// pitem_plus
	// $('.pitem_plus').on('click', function () {
	// 	btn = $(this)
	// 	$.ajax({
	// 		url: "/admin/products/item/get.php?pitem_plus",
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












	// 
	$('html').on('click', '.upl_logo_img_del', function() {
		btn = $(this)
		$.ajax({
			url: "/products/item/get.php?del_imgs",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id'), }),
			beforeSend: function(){ },
			error: function(data){ },
			success: function(data){
				mess('Өшірілді')
				btn.parent('.upl_logo').remove()
			},
		})
	})


	// 
	$('html').on('click', '.imgs_updq_pop', function() {
		$('.imgs_add_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
		$('.item_file2').attr('data-item-id', $(this).attr('data-id'))
		btn = $(this)
		$.ajax({
			url: "/products/item/imgs_item.php?pitem_d",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id'), }),
			beforeSend: function(){ },
			error: function(data){ },
			success: function(data){
				$('.imgs_add_block .upl_lv').html(data);
				// $('.lazy_img').lazy({effect:"fadeIn", effectTime:300, threshold:0})
			},
		})
	})
	$('html').on('click', '.imgs_add_back', function() {
		$('.imgs_add_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
		// $('.imgs_add_block .pop_bl_cl').html('');
		if ($('.imgs_add_block').attr('data-load') == 1) location.reload();
	})

	$('html').on('input', '.view_updq_qn', function () {
		btn = $(this)
		$.ajax({
			url: "/products/item/view/get.php?pitem_qn",
			type: "POST",
			dataType: "html",
			data: ({ 
				quantity: btn.attr('data-val'),
				id: btn.data('id'),
			}),
			beforeSend: function(){ },
			error: function(data){ },
			success: function(data){
				$('.pitem_updq_block').attr('data-load', 1)
				console.log(data);
				console.log(btn.attr('data-val'));
			},
		})
	})




	$('.item_ava_clc2').click(function(){ $(this).siblings('.item_file2').click() })
	$(".item_file2").change(function(){
		tfile = $(this)
		if (window.FormData === undefined) mess('В вашем браузере FormData не поддерживается')
		else {

			$.ajax({
				url: "/products/item/get.php?add_sess",
				type: "POST",
				dataType: "html",
				data: ({ 
					id: tfile.data('id'),
					item_id: tfile.data('item-id'),
				}),
				beforeSend: function(){ },
				error: function(data){ },
				success: function(data){
					console.log(data);
				},
			})

			var formData = new FormData();
			$.each(tfile[0].files, function(key, input){ formData.append('file[]', input); });
			$.ajax({
				type: "POST",
				url: "/products/item/get.php?add_item_photo2",
				// crossDomain: true,
				cache: false,
				contentType: false,
				processData: false,
				dataType: 'json',
				data: formData,
				success: function(msg){
					if (msg.error == '') {
						$.each(msg.file, function(index, value){
							tfile_n = 'url(/assets/uploads/products/'+value+')'
							$('.upl_lv').prepend('<div class="upl_logo " data-val="' + value + '"><div class="upl_logo_img lazy_img upl_logo_img_del" style="background-image:' + tfile_n + '"></div></div>')
						})
					} else mess(msg.error)
				},
				beforeSend: function(){ },
				error: function(msg){ },
			});
		}
	});






}) // end jquery