$(document).ready(function() {

	
	$('.atops_clc').click(function(){
		history.back();
	})



	// menu
	$('div.umenu_ci2').click(function(){
		$(location).attr('href', $(this).attr('href'));
	})














	// 
	$('.ub1_lx').on('click', function() {
		$(this).parent().toggleClass('menu_act');
	})



	// 
	// if ($(window).width() < 501) {
	// 	if ($('.uitemc_umi').length == 1){
	// 		$('.uitemc_umi').css('width', '100%')
	// 	} else if ($('.uitemc_umi').length == 2) {
	// 		$('.uitemc_umi').css('width', '50%')
	// 	} else if ($('.uitemc_umi').length > 3) {
	// 		$('.uitemc_umi:nth-child(1n+3)').addClass('dsp_n')
	// 		$('.uitemc_umid').removeClass('dsp_n')
	// 		$('.uitemc_umidcs').html($('.uitemc_umi.dsp_n'))
	// 		$('.uitemc_umidcs .uitemc_umi').removeClass('dsp_n')
	// 	}
	// }

	// $('.uitemc_umidl').on('click', function () { 
	// 	$('.uitemc_umid').toggleClass('uitemc_umid_act')
	// })


	// // скрол
	// let scroll = $(window).scrollTop()
	// if (scroll > 30) $('.uitemc_u').addClass('uitemc_u_act')
  	// else $('.uitemc_u').removeClass('uitemc_u_act')
	// $(window).scroll(function() {
	// 	scroll = $(window).scrollTop()
	// 	if (scroll > 30) $('.uitemc_u').addClass('uitemc_u_act')
  	// 	else $('.uitemc_u').removeClass('uitemc_u_act')
	// })




	// menu clc
	$('.ub1_ly').click(function() { if ($(window).width() > 1024 && $(window).width() <= 1440) $('.ub1').toggleClass('ub1_ms') })











	 




	// 
	// $('.usign_fcd').on('input', function(e) {
	// 	if (e.keyCode == 13) {
	// 		console.log('clc');
	// 	}
		
	// 	console.log(e.keyCode);
	// })
	// 
	
	// $('html, body').on('keydown', '.usign_fcd', function(e){
	// 	if (e.keyCode == 8 && $(this).val() == '') {
	// 		if ($(this).hasClass('usign_fcd2')) $('.usign_fcd1').focus()
	// 		if ($(this).hasClass('usign_fcd3')) $('.usign_fcd2').focus()
	// 		if ($(this).hasClass('usign_fcd4')) $('.usign_fcd3').focus()
	// 	}
	// })
	// $('.usign_fcd').on('input', function(e) {
	// 	if ($(this).val() != '') {
	// 		if ($(this).hasClass('usign_fcd1')) $('.usign_fcd2').focus()
	// 		if ($(this).hasClass('usign_fcd2')) $('.usign_fcd3').focus()
	// 		if ($(this).hasClass('usign_fcd3')) $('.usign_fcd4').focus()
	// 	}
	// })



































	$('.btn_ubd_acc').click(function () { 
		// form
		this_btn = $(this)
		n_name = $('.name')
		surname = $('.surname')
		sex = $('.sex')
		age = $('.age')
		mail = $('.mail')
		phone = $('.phone')
		password = $('.password')

		if (n_name.attr('data-sel') != 1 || surname.attr('data-sel') != 1 || age.attr('data-sel') != 1 || mail.attr('data-sel') != 1 || phone.attr('data-sel') != 1 || password.attr('data-sel') != 1) mess('Форманы толтырыңыз')
		else {
			$.ajax({
				url: "/user/get.php?ubd_acc",
				type: "POST",
				dataType: "html",
				data: ({
					n_name: n_name.attr('data-val'),
					surname: surname.attr('data-val'),
					sex: sex.attr('data-val'),
					age: age.attr('data-val'),
					mail: mail.attr('data-val'),
					phone: phone.attr('data-val'),
					password: password.attr('data-val')
				}),
				success: function(data){
					if (data == 'yes') {
						mess('Cәтті сақталды!')
					} else {console.log(data)}
					console.log(data);
				},
				beforeSend: function(){},
				error: function(data){console.log(data)}
			})
		}
	})
	
	
	


	$('.phone').on('input', function() {
		if ($('.btn_fdal').parent().attr('data-type') == 'reg_info') {
			$('.btn_fdal').children('span').html($('.btn_fdal').attr('data-aut'))
			$('.btn_fdal').parent().attr('data-type', 'aut')
			$('.lg_top_head > *').each(function() {$(this).html($(this).attr('data-lg'))})
		}
	})





	// 
	$('.btn_lc_log').on('click', function() {

		phone = $(this).parent().siblings().children('.phone');
		form_sms = $(this).parent().siblings().children('.form_sms');
		num = '';
		$('.form_cn_code2 input').each(function() {
			num += $(this).attr('data-val')
		});
		
		if (phone.attr('data-sel') != 1 || num.length != 4) {
			phone.parent().addClass('form_pust')
			form_sms.html(form_sms.attr('data-code-pust'))
			form_sms.parent().removeClass('dsp_n')
		} else {
			$.ajax({
				url: "/user/get.php?ls_aut",
				type: "POST",
				dataType: "html",
				data: ({phone: phone.attr('data-val'), code: num}),
				success: function(data){
					if (data == 'yes') {
						location.reload();
					} else if (data == 'none') {
						form_sms.parent().removeClass('dsp_n')
						form_sms.html(form_sms.attr('data-code'))
					} else {console.log(data)}
				},
				beforeSend: function(){},
				error: function(data){console.log(data)}
			})
		}

	});







	// bookmark
	$('.bq3_ci_book').on('click', function() {
		var btn = $(this)
		if (btn.hasClass('bq3_ci_book_act') == false) { 
         btn.addClass('bq3_ci_book_act')
			$.ajax({
				url: "/user/get.php?bookmark_plus",
				type: "POST",
				dataType: "html",
				data: ({ cours_id: btn.attr('data-id') }),
				success: function(data){ 
               if (data=='yes') {
                  mess('Сақтаулыға сақталынды')
                  btn.children('.btn').children('i').addClass('fas')
               }
            },
				beforeSend: function(){ },
				error: function(data){ mess('Ошибка..') }
			})
		} else {
         btn.removeClass('bq3_ci_book_act')
         btn.children('.btn').children('i').removeClass('fas')
         $.ajax({
            url: "/user/get.php?bookmark_del",
				type: "POST",
				dataType: "html",
				data: ({ cours_id: btn.attr('data-id') }),
				success: function(data){ 
               mess('Сақтаулыдан алып тасталынды')
               if (data=='yes') {if (btn.hasClass('bq3_ci_book_act2')==true) btn.parent().remove()}
               if (data=='none') { 
                  $('.bookmark_nn').removeClass('dsp_n')
                  if (btn.hasClass('bq3_ci_book_act2')==true) btn.parent().parent().remove()
               }
               console.log(data);
            },
				beforeSend: function(){ },
				error: function(data){ mess('Ошибка..') }
			})

		}
	})




	$('.form_im_btn_clc .form_im_btn_i').click(function(){
		if ($(this).hasClass('form_im_btn_act') == false) {
			$(this).siblings('.form_im_btn_i').removeClass('form_im_btn_act')
			$(this).addClass('form_im_btn_act')
			$(this).parent().attr('data-val', $(this).attr('data-val'))
		}
	})





	// 
	$('.rad1').on('click', function () { 
		if ($(this).parent().attr('data-sel') == 0) {
			$(this).addClass('form_radio_act')
			$(this).parent().attr('data-sel', 1)

			if ($(this).hasClass('answer') == true) {
				$(this).addClass('form_radio_true');
				var answer = 1;
				mess('Сіздің жауабыңыз дұрыс');
			} else {
				$(this).addClass('form_radio_false');
				$(this).siblings('.answer').addClass('form_radio_true');
				var answer = 0;
				mess('Сіздің жауабыңыз қате, талқылауды қараңыз');
			}

			$.ajax({
				url: "/user/get.php?test_answer",
				type: "POST",
				dataType: "html",
				data: ({ 
					answer: answer, 
					v: $(this).attr('data-val'), 
					test_id: $(this).parent().attr('data-test-id'), 
					lesson_id: $(this).parent().attr('data-lesson-id') 
				}),
				success: function(data){ },
				beforeSend: function(){ },
				error: function(data){ }
			})

		}
	})


	$('.lsb_it1 .lsb_i').on('click', function () {
		if ($(this).hasClass('lsb_act') != true) {
			var nm = Number($(this).attr('data-number')) + 1;
			var cls = '.lsb_i[data-number="' + nm + '"]';
			$(cls).removeClass('dsp_n');
			$(this).addClass('lsb_act');
	
			$.ajax({
				url: "/user/get.php?sub_info_upd",
				type: "POST",
				dataType: "html",
				data: ({ lesson_id: $(this).parent().attr('data-lesson-id'), nm: nm }),
				success: function(data){ },
				beforeSend: function(){ },
				error: function(data){ }
			})
		}
	})

	$('.btn_hw').on('click', function () {

		btn = $(this)
		inp_hm = $('.inp_hm')

		if (inp_hm.val() != '') {
			$.ajax({
				url: "/user/get.php?home_work",
				type: "POST",
				dataType: "html",
				data: ({ 
					cours_id: btn.attr('data-cours-id'), 
					pack_id: btn.attr('data-pack-id'), 
					lesson_id: btn.attr('data-lesson-id'), 
					inp_hm: inp_hm.val()
				}),
				success: function(data){ 
					if (data == 'yes') { location.reload(); }
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		} else { mess('Жазуды ұмыттыңыз') }
	})



	$('.btn_rev').on('click', function () {

		btn = $(this)
		inp_rev = $('.inp_rev')

		if (inp_rev.val() != '') {
			$.ajax({
				url: "/user/get.php?rev_add",
				type: "POST",
				dataType: "html",
				data: ({ 
					cours_id: btn.attr('data-cours-id'), 
					inp_rev: inp_rev.val()
				}),
				success: function(data){ 
					if (data == 'yes') { location.reload(); }
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		} else { mess('Жазуды ұмыттыңыз') }
	})


	// 
	$('.btn_add_ques').on('click', function () {

		btn = $(this)
		txt = $('.inp_form')

		if (txt.val() != '') {
			$.ajax({
				url: "/user/get.php?add_ques",
				type: "POST",
				dataType: "html",
				data: ({ 
					cours_id: btn.attr('data-cours-id'), 
					pack_id: btn.attr('data-pack-id'), 
					lesson_id: btn.attr('data-lesson-id'), 
					txt: txt.val()
				}),
				success: function(data){ 
					if (data == 'yes') { location.reload(); }
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		} else { mess('Жазуды ұмыттыңыз') }
	})


	// 
	$('.btn_add_review').on('click', function () {

		btn = $(this)
		txt = $('.inp_form')

		if (txt.val() == '') mess('Жазуды ұмыттыңыз')
		else {
			$.ajax({
				url: "/user/cours/masterclass/get.php?add_review",
				type: "POST",
				dataType: "html",
				data: ({ 
					mc_id: btn.attr('data-mc-id'),
					type: btn.attr('data-type'),
					txt: txt.val()
				}),
				success: function(data){ 
					if (data == 'yes') location.reload();
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		} 
	})

	// 
	$('.lsb_crv_ictd').on('click', function () {
		btn = $(this)
		$.ajax({
			url: "/user/cours/masterclass/get.php?del_review",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id') }),
			success: function(data){
				if (data == 'yes') {
					if (btn.attr('data-type') == 1) btn.parents('.lsb_crv_u').remove();
					if (btn.attr('data-type') == 2) {
						if (btn.parents('.lsb_crv_u2').children('.lsb_crv_i').length > 1) btn.parents('.lsb_crv_i').remove();
						else btn.parents('.lsb_crv_u2').remove();
					}
				}
				console.log(data);
			},
			beforeSend: function(){ },
			error: function(data){ }
		})
	})

	// add user
	$('.review_answer_open').click(function(){
		$('.review_answer').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
		$('.review_answer .btn_review_answer').attr('data-id', $(this).attr('data-id'))
	})
	$('.review_answer_back').click(function(){
		$('.review_answer').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})
	$('.btn_review_answer').on('click', function() {
		btn = $(this); txt = $('.inp_form2');
		if (txt.val() == '') mess('Жазуды ұмыттыңыз')
		else {
			$.ajax({
				url: "/user/cours/masterclass/get.php?add_review_answer",
				type: "POST",
				dataType: "html",
				data: ({ 
					id: btn.attr('data-id'),
					txt: txt.val()
				}),
				success: function(data){ 
					if (data == 'yes') location.reload();
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		} 
	})












	// 
	$('.rad2').on('click', function () { 
		if ($(this).parent().attr('data-sel') == 0) {
			$(this).addClass('form_radio_act form_radio_true')
			$(this).parent().children('.rad2').removeClass('form_radio_false')
			$(this).parent().attr('data-sel', 1)

			san = Number($(this).parent().parent().siblings('.btn').attr('data-ball'))
			san = san + Number($(this).attr('data-ball'))
			$(this).parent().parent().siblings('.btn').attr('data-ball', san)
		}
	})

	$('.rad2_btn').on('click', function () { 
		san2 = 0
		$(this).siblings('.lsb_icm').children('.form_im').each(function () { 
			if ($(this).attr('data-sel') == 0) { 
				mess('Тест толық орындаңыз')
				$(this).children('.rad2').addClass('form_radio_false')
			} else san2++
		})
		if (san2 == $(this).attr('data-number')){
			$(this).siblings('.otv_rad2').removeClass('dsp_n')
			if ($(this).attr('data-min') <= $(this).attr('data-ball')) $(this).siblings('.otv_rad2').children('.v1').removeClass('dsp_n')
			if ($(this).attr('data-max') >= $(this).attr('data-ball')) $(this).siblings('.otv_rad2').children('.v2').removeClass('dsp_n')
		}
	})


















	




	// 
	// if ($(window).width() < 501) {}

	// $('.uhwa_psi2').on('click', function(e) {
	// 	e.preventDefault();
	// 	if ($(this).parents('.uhwa_cp').hasClass('uhwa_cp_act') == true) {
	// 		$(this).parents('.uhwa_cp').removeClass('uhwa_cp_act')
	// 		$(this).parents('.uhwa_cp').height(76)
	// 	} else {
	// 		$('.uhwa_cp').removeClass('uhwa_psi2_act')
	// 		$('.uhwa_cp').height(76)
	// 		$(this).parents('.uhwa_cp').addClass('uhwa_cp_act')
	// 		s = $(this).parents('.uhwa_cp').children('.uhwa_cb').children('.uhwa_i').length
	// 		$(this).parents('.uhwa_cp').height(s * 100 + 100)
	// 	}
	// })


	// $('.uhwa_i_sel').on('click', function () {
	// 	btn = $(this)
	// 	if ($(window).width() < 501) {
	// 		location.href = '/user/homework/admin/cours/list.php?id=' + btn.attr('data-cours-id') + '&lesson_id=' + btn.attr('data-lesson-id');
	// 	} else {
	// 		$.ajax({
	// 			url: "/user/homework/admin/cours/select.php?select_work",
	// 			type: "POST",
	// 			dataType: "html",
	// 			data: ({ lesson_id: btn.attr('data-lesson-id') }),
	// 			success: function(data){
	// 				$('.uhwa_c_sel').html(data)
	// 				// console.log(data)
	// 			},
	// 			beforeSend: function(){ },
	// 			error: function(data){ console.log(data) }
	// 		})
	// 	}
	// })







	// chat
	$('.btn_chat_send').on('click', function () {

		btn = $(this)
		txt = $('.inp_form')

		if (txt.val() == '') mess('Жазуды ұмыттыңыз')
		else {
			$.ajax({
				url: "/user/chat/get.php?add_chat_item",
				type: "POST",
				dataType: "html",
				data: ({ 
					id: btn.attr('data-chat-id'),
					txt: txt.val()
				}),
				success: function(data){ 
					if (data == 'yes') location.reload();
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		} 
	})







	// 
	$('html').on('click', '.uc_uibo', function() {
		if ($(this).parent().hasClass("uc_uibs_act")	!= true) {
			$('.uc_uibo').parent().removeClass("uc_uibs_act");
			$(this).parent().addClass("uc_uibs_act");
		} else $('.uc_uibo').parent().removeClass("uc_uibs_act");
	})

	// 
	$('html').on('click', '.ucours_tmi', function() {
		if ($(this).parent().hasClass("ucours_tm_act")	!= true) {
			$('.ucours_tmi').parent().removeClass("ucours_tm_act");
			$(this).parent().addClass("ucours_tm_act");
		} else $('.ucours_tmi').parent().removeClass("ucours_tm_act");
	})


	// 
	$('.menu_clc').on('click', function() {
		$('.menuc').addClass('menuc_act')
		$('#html').addClass('ovr_h')
	})
	$('.menu_back').on('click', function() {
		$('.menuc').removeClass('menuc_act')
		$('#html').removeClass('ovr_h')
	})



	// скрол
	let scroll = $(window).scrollTop()
	if (scroll > 64) $('.navh').addClass('navh_act')
	else $('.navh').removeClass('navh_act')
	$(window).scroll(function() {
		scroll = $(window).scrollTop()
		if (scroll > 64) $('.navh').addClass('navh_act')
		else $('.navh').removeClass('navh_act')
	})







	// add cart
	$('html').on('click', '.add_cart', function() {
		btn = $(this)
		$.ajax({
			url: "/shoppingcart/get.php?add_cart",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id'), }),
			success: function(data){
				mess(data)
			},
			beforeSend: function(){ },
			error: function(data){ }
		})
	})
	// delete cart
	$('html').on('click', '.delete_cart', function() {
		btn = $(this)
		$.ajax({
			url: "/shoppingcart/get.php?delete_cart",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id'), }),
			success: function(data){
				// mess(data)
				btn.parents('.carts_i').remove();
			},
			beforeSend: function(){ },
			error: function(data){ }
		})
	})
	// minus cart
	$('html').on('click', '.minus_cart', function() {
		btn = $(this)
		quantity = btn.parent().attr('data-quantity') - 1
		price = btn.parent().attr('data-price')
		if (quantity == 0) {
			 
		} else {
			$.ajax({
				url: "/shoppingcart/get.php?minus_cart",
				type: "POST",
				dataType: "html",
				data: ({ id: btn.parent().attr('data-id'), }),
				success: function(data){
					// mess(data); console.log(data);
					btn.parent().attr('data-quantity', quantity)
					btn.siblings('.uc_uin_calc_q').val(quantity + ' шт')
					btn.parents('.carts_iz_calc').siblings('.carts_iz').children('.item_price').children('span').html(quantity * price)
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		}
	})
	// plus cart
	$('html').on('click', '.plus_cart', function() {
		btn = $(this)
		quantity = parseInt(btn.parent().attr('data-quantity')) + 1
		price = btn.parent().attr('data-price')
		// if (q == 1) {
			 
		// } else {
			$.ajax({
				url: "/shoppingcart/get.php?plus_cart",
				type: "POST",
				dataType: "html",
				data: ({ id: btn.parent().attr('data-id'), }),
				success: function(data){
					btn.parent().attr('data-quantity', quantity)
					btn.siblings('.uc_uin_calc_q').val((quantity) + ' шт')
					btn.parents('.carts_iz_calc').siblings('.carts_iz').children('.item_price').children('span').html(quantity * price)
					// mess(data); console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		// }
	})
	// quantity cart
	$('html').on('input', '.quantity_cart', function() {
		btn = $(this)
		quantity = btn.attr('data-val')
		price = btn.parent().attr('data-price')

		// if (q == 1) {
			 
		// } else {
			$.ajax({
				url: "/shoppingcart/get.php?quantity_cart",
				type: "POST",
				dataType: "html",
				data: ({ 
					id: btn.parent().attr('data-id'),
					quantity: quantity,
				}),
				success: function(data){
					btn.parent().attr('data-quantity', quantity)
					btn.parents('.carts_iz_calc').siblings('.carts_iz').children('.item_price').children('span').html(quantity * price)
					// mess(data); console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		// }
	})
	





	




	// add favorites
	$('html').on('click', '.add_favorites', function() {
		btn = $(this)
		$.ajax({
			url: "/favorites/get.php?add_favorites",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id'), }),
			success: function(data){
				if (data == 'ins') btn.addClass('item_favorites_act')
				else if (data == 'del') btn.removeClass('item_favorites_act')
				else mess(data)
			},
			beforeSend: function(){ },
			error: function(data){ }
		})
	})
	// add favorites 2
	$('html').on('click', '.add_favorites2', function() {
		btn = $(this)
		$.ajax({
			url: "/favorites/get.php?add_favorites",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id'), }),
			success: function(data){
				if (data == 'del') {
					btn.parents('.item').remove();
				} else mess(data)
			},
			beforeSend: function(){ },
			error: function(data){ }
		})
	})


















	// СМС
	$('.disb_zab').click(function(){
		$('.fr').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
	})
	$('.zabr_back').click(function(){
		$('.fr').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})

	$('.orderSend').on('click', function() {
		var name = $(this).parent().siblings().children('.name')
		var phone = $(this).parent().siblings().children('.phone')
		if (name.attr('data-pr') != 1 || phone.attr('data-pr') != 1) { mess('Введите свой данный') }
		else {
			$.ajax({
				url: "/send/?mess",
				type: "POST",
				dataType: "html",
				data: ({name: name.val(), phone: phone.val()}),
				success: function(data){
					if (data == 'yes') mess('Сәтті жіберілді')
					else mess('Қайта кіріуіңізді сұраймын!')
				},
				beforeSend: function(){ mess('Отправка..') },
				error: function(data){ mess('Ошибка..') }
			})
		}
	})



	$('.orderSend2').on('click', function() {
		var name = $(this).parent().siblings().children('.name')
		var phone = $(this).parent().siblings().children('.phone')
		if (name.attr('data-sel') != 1 || phone.attr('data-sel') != 1) mess('Форманы толтырыңыз')
		else {
			$.ajax({
				url: "/config/send.php?mess2",
				type: "POST",
				dataType: "html",
				data: ({
					name: name.val(),
					phone: phone.val()
				}),
				success: function(data){
					if (data == 'yes') location.href = '/cours/maksat-and-motivation2/video.php';
					else mess('Қайта кіріуіңізді сұраймын!')
				},
				beforeSend: function(){},
				error: function(data){}
			})
		}
	})
	










	


   // $('.progress_ring_c').each(function() {
   //    radius = $(this).attr('r');
   //    precent = $(this).attr('data-precent')
   //    circumference = 2 * Math.PI * radius;
   //    $(this).css('strokeDasharray', circumference + ' ' + circumference)
   //    $(this).css('strokeDashoffset', circumference - precent / 100 * circumference)
   // });


	// 
	// var swiper = new Swiper(".swiper_catalog", {
	// 	slidesPerView: "auto",
	// 	navigation: {
	// 	  nextEl: ".swiper-button-next1",
	// 	  prevEl: ".swiper-button-prev1",
	// 	},
	// });
	// var swiper = new Swiper(".swiper_catalog2", {
	// 	slidesPerView: "auto",
	// 	navigation: {
	// 	  nextEl: ".swiper-button-next2",
	// 	  prevEl: ".swiper-button-prev2",
	// 	},
	// });













	

	// var slide_min = new Swiper('.slide_min', {
 //      	slidesPerView: 'auto',
 //      	pagination: {
	//         el: '.slide_min_pag',
	//         type: 'progressbar',
	// 	},
 //    });
 //    var slide_max = new Swiper('.slide_max', {
 //      	slidesPerView: 'auto',
 //      	pagination: {
	//         el: '.slide_max_pag',
	//         type: 'progressbar',
	// 	},
	// 	navigation: {
	// 		nextEl: '.slide_max_next',
	// 		prevEl: '.slide_max_prev',
	// 	},
 //    });
 //    var home_cours_cat_c = new Swiper('.home_cours_cat_c', {
 //      	slidesPerView: 'auto',
 //      	pagination: {
	//         el: '.home_cours_cat_c_pag',
	//         type: 'progressbar',
	// 	},
 //    });



	// var galleryThumbs = new Swiper('.gallery-thumbs', {
	//     slidesPerView: 'auto',
	//     freeMode: true,
	//     watchSlidesVisibility: true,
	//     watchSlidesProgress: true,
 //    });
 //    var galleryTop = new Swiper('.gallery-top', {
 //    	autoHeight: true,
	// 	loop:true,
 //      	thumbs: { swiper: galleryThumbs }
 //    });


    // кaрусел
	// var galleryThumbs = new Swiper('.gallery-thumbs', {
	// 	loop:true,
	// 	slidesPerView: 3,
	// 	allowTouchMove: false,
	// 	freeMode: true,
	// 	watchSlidesVisibility: true,
	// 	watchSlidesProgress: true,
	// 	breakpoints: {
	//         360: {
	//           	slidesPerView: 2,
	// 			allowTouchMove: true,
	//         },
	//     }
	// })
	// var galleryTop = new Swiper('.gallery-top', {
	// 	autoplay: {
	//     	delay: 5000,
	//   	},
	//   	speed: 500,
	// 	loop: true,
	// 	navigation: {
	// 		nextEl: '.swiper-button-next',
	// 		prevEl: '.swiper-button-prev',
	// 	},
	// 	thumbs: {
	// 		swiper: galleryThumbs,
	// 	},
	// })





	$('.bq_cipcni').on('click', function () { 
		$(this).siblings('.bq_cipcni').removeClass('bq_cipcni_act');
		$(this).addClass('bq_cipcni_act');
		$(this).parent().siblings('p').html($(this).attr('data-price'))
	})

	$('.btn_ukl').click(function (e) { 
      e.preventDefault();
      $('.oko').addClass('oko_act')
   });
   $('.oko_close').click(function (e) { 
      e.preventDefault();
      $('.oko').removeClass('oko_act')
   });



	// $('.lazy_rev').lazy({effect:"fadeIn",effectTime:500,threshold:0})
	// var mySwiper5 = new Swiper(".mySwiper5", {
	//    slidesPerView: 1,
	// 	autoHeight: true,
	// 	navigation: {
	// 		nextEl: ".swiper-button-next5",
	// 		prevEl: ".swiper-button-prev5",
	// 	},
	// 	on:{
	// 		slideChange:function(){
	// 			$('.lazy_rev').lazy({effect:"fadeIn",effectTime:500,threshold:0})
	// 		}
	// 	},
	// });














	
	// cashbox_pay
	$('.loginq_clc').click(function(){
		$('.loginq_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
		$('.btn_sign').attr('data-id', $(this).attr('data-id'))
	})
	$('.loginq_back').click(function(){
		$('.loginq_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})

	// sign in
	$('.btn_sign').on('click', function() {
		if ($('.phone').attr('data-sel') == 0 || $('.password').attr('data-sel') == 0) mess('Жеке кодыңызды енгізіңіз')
		else {
			$.ajax({
				url: "/get.php?sign",
				type: "POST",
				dataType: "html",
				data: ({ 
					phone: $('.phone').attr('data-val'),
					password: $('.password').attr('data-val'),
				}),
				beforeSend: function(){ },
				error: function(data){ console.log(data) },
				success: function(data){
					if (data == 'yes') location.href = '/orders/';
					else mess('Жеке пароліңіз қате')
				},
			})
		}
	});




	// 

	// let keyCode;
	// $('html').on('keyup', '.loginq_form input', function (e) {
	// 	// $('html').keyup(function(e){
	// 	// 	if(e.keyCode == 8)alert('backspace trapped')
	// 	// })
	// 	// console.log(e.keyCode);
	// 	keyCode = e.keyCode

	// 	nmb = Number($(this).attr('data-number'))
	// 	if (e.keyCode == 8) {
	// 		// console.log('Басылды');
	// 		if (nmb == 4) {
	// 			$('.loginq_number3').focus()
	// 		} else if (nmb == 3) {
	// 			$('.loginq_number2').focus()
	// 		} else if (nmb == 2) {
	// 			$('.loginq_number1').focus()
	// 		} else {
	// 			console.log('Последный');
	// 		}
	// 	}
	// })

	// $('html').on('input', '.loginq_form input', function (e) {

	// 	console.log(keyCode);

	// 	nmb = Number($(this).attr('data-number'))
	// 	if (nmb == 1) {
	// 		$('.loginq_number2').focus()
	// 	} else if (nmb == 2) {
	// 		$('.loginq_number3').focus()
	// 	} else if (nmb == 3) {
	// 		$('.loginq_number4').focus()
	// 	} else {
	// 		console.log('Последный');
	// 	}
	// })

  











})