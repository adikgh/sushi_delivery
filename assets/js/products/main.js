// start jquery
$(document).ready(function() {




	// search
	$('.product_search').on('input', function () {
		// $.ajax({
		// 	url: "/products/get.php?product_barcode",
		// 	type: "POST",
		// 	dataType: "html",
		// 	data: ({ result: $('.product_search').val(), }),
		// 	success: function(data){
		// 		if (data != 'none') $(location).attr('href', '/products/item?id=' + data);
		// 	},
		// 	beforeSend: function(){ },
		// 	error: function(data){ }
		// })

		if ($(this).val() == '') {
			$('.uc_u2q').removeClass('dsp_n')
			$('.uc_p').removeClass('dsp_n')
			$('.uc_u2qm').addClass('dsp_n')
		} else {
			$('.uc_u2q').addClass('dsp_n')
			$('.uc_p').addClass('dsp_n')
			$('.uc_u2qm').removeClass('dsp_n')
			$.ajax({
				url: "/products/search.php?product_search",
				type: "POST",
				dataType: "html",
				data: ({ result: $('.product_search').val(), }),
				success: function(data){
					$('.uc_u2qm').html(data)
					$('.lazy_img').lazy({effect:"fadeIn", effectTime:300, threshold:0})
					// console.log(data)
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		}
	})


	// search
	$('.product_item_search').on('input', function () {
		if ($(this).val() == '') {
			$('.uc_u2q').removeClass('dsp_n')
			$('.uc_p').removeClass('dsp_n')
			$('.uc_u2qm').addClass('dsp_n')
		} else {
			$('.uc_u2q').addClass('dsp_n')
			$('.uc_p').addClass('dsp_n')
			$('.uc_u2qm').removeClass('dsp_n')
			$.ajax({
				url: "/products/all/search_item.php?product_search",
				type: "POST",
				dataType: "html",
				data: ({ result: $('.product_item_search').val(), }),
				success: function(data){
					$('.uc_u2qm tbody').html(data)
					$('.lazy_img').lazy({effect:"fadeIn", effectTime:300, threshold:0})
					// console.log(data)
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		}
	})


	// 
	$('html').on('click', '.form_prd_online', function() {
		btn = $(this)
		$.ajax({
			url: "/products/get.php?form_prd_online",
			type: "POST",
			dataType: "html",
			data: ({
				id: btn.attr('data-id'),
				val: btn.siblings('input').attr('data-val'),
			}),
			beforeSend: function(){ },
			error: function(data){ },
			success: function(data){
				if (data == 'yes') mess('Успешно')
				else mess('Ошибка!'); console.log(data);
			},
		})
	})


	// delete
	$('html').on('click', '.pr_btn_delete', function() {
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


   // product_img_add
	$("html").on('change', '.product_img', function(){
		tfile = $(this)
		if (window.FormData === undefined) mess('Бұл формат келмейді')
		else {
			var formData = new FormData();
			formData.append('file', $(this)[0].files[0]);
			$.ajax({
				// async: true,
				// url: "https://cors-anywhere.herokuapp.com/https://lighterior.kz/admin/file.php?product_img_add",
				url: "/products/item/get.php?product_img_add",
				type: "POST",
				crossDomain: true,
				// method: "POST",
				// headers: { "content-type": "application/x-www-form-urlencoded", },
				cache: false,
				contentType: false,
				processData: false,
				dataType: 'json',
				data: formData,
				success: function(msg){
					if (msg.error == '') {
						tfile_n = 'url(/assets/uploads/products/'+msg.file+')'
						tfile.attr('data-val', msg.file)
						tfile.siblings('.form_im_img').addClass('form_im_img2')
						tfile.siblings('.form_im_img').css('background-image', tfile_n)
					} else mess(msg.error)
				},
				beforeSend: function(){ },
				error: function(msg){ }
			});
		}
	});




   // add product
	$('.product_add_pop').click(function(){
		$('.product_add_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
	})
	$('.product_add_back').click(function(){
		$('.product_add_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})
	$('html').on('click', '.price1_clc', function() { $('.price1_bl').toggleClass('price1_bl_act') });
	$('html').on('click', '.setting1_clc', function() { $('.setting1_bl').toggleClass('setting1_bl_act') });
	$('html').on('click', '.info1_clc', function() { $('.info1_bl').toggleClass('info1_bl_act') });

   $('.pr_img_add').click(function(){ $(this).siblings('.pr_img').click() })


   
	$('.product_add').on('click', function() {
		if ($('.pr_name').attr('data-sel')) {
			$.ajax({
				url: "/products/get.php?product_add",
				type: "POST",
				dataType: "html",
				data: ({
					name: $('.pr_name').attr('data-val'), 
					price: $('.pr_price').attr('data-val'), 
					catalog: $('.pr_catalog').attr('data-val'),
					// warehouses: $('.pr_warehouses').attr('data-val'),
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
		} else mess('Введите свой данный')
	})


	
	// clone product
	$('html').on('click', '.product2_add_pop', function(){
		$('.product2_add_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
		btn = $(this)
		$.ajax({
			url: "/products/pop_clone.php?clone",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id'), }),
			success: function(data){ 
				$('.product2_add_block .pop_bl_cl').html(data);
				$('.fr_number').mask('# ##0', {reverse: true});
				$('.fr_price').mask('# ##0 тг', {reverse: true});
			},
			beforeSend: function(){ },
			error: function(data){ }
		})
	})
	$('html').on('click', '.product2_add_back', function(){
		$('.product2_add_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
		$('.product2_add_block .pop_bl_cl').html('');
	})
	$('html').on('click', '.dpr_img_add', function(){ $(this).siblings('.dpr_img').click() })
	$('html').on('click', '.dproduct_add', function() {		
		if ($('.dpr_article').attr('data-sel') != 1) {
			if ($('.dpr_article').attr('data-sel') != 1) mess('Введите свой данный')
		} else {
			$.ajax({
				url: "/products/get.php?product_add",
				type: "POST",
				dataType: "html",
				data: ({
					name: $('.dpr_name').val(), article: $('.dpr_article').attr('data-val'),
					barcode: $('.dpr_barcode').attr('data-val'), catalog: $('.dpr_catalog').attr('data-val'),
					quantity: $('.dpr_quantity').attr('data-val'), price: $('.dpr_price').attr('data-val'), 
					purchase_price: $('.dpr_purchase_price').attr('data-val'), discount_price: $('.dpr_discount_price').attr('data-val'),
					img: $('.dpr_img').attr('data-val'), brand: $('.dpr_brand').val(),
					color: $('.dpr_color').val(), size: $('.dpr_size').val(),
					warehouses: $('.pr_warehouses').attr('data-val'),
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











}) // end jquery