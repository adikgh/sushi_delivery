// start jquery
$(document).ready(function() {



	// скрол
	// let scroll = $(window).scrollTop()
	// if (scroll > 80) $('.header').addClass('header_fix')
	// else $('.header').removeClass('header_fix')
	// if (scroll > 600) $('.posmz').addClass('posmz_act')
	// else $('.posmz').removeClass('posmz_act')
	// if (scroll > 80) $('.pop_btn').addClass('pop_btn_fix')
	// else $('.pop_btn').removeClass('pop_btn_fix')
	// $(window).scroll(function() {
	// 	scroll = $(window).scrollTop()
	// 	if (scroll > 80) $('.header').addClass('header_fix')
	// 	else $('.header').removeClass('header_fix')
	// 	if (scroll > 600) $('.posmz').addClass('posmz_act')
	// 	else $('.posmz').removeClass('posmz_act')
	// 	if (scroll > 80) $('.pop_btn').addClass('pop_btn_fix')
	// 	else $('.pop_btn').removeClass('pop_btn_fix')
	// })

	// 
	$('.ub1_lx').on('click', function() {
		$(this).parent().toggleClass('menu_act');
	})



	// 
	if ($(window).width() < 501) {
		if ($('.uitemc_umi').length == 1){
			$('.uitemc_umi').css('width', '100%')
		} else if ($('.uitemc_umi').length == 2) {
			$('.uitemc_umi').css('width', '50%')
		} else if ($('.uitemc_umi').length > 3) {
			$('.uitemc_umi:nth-child(1n+3)').addClass('dsp_n')
			$('.uitemc_umid').removeClass('dsp_n')
			$('.uitemc_umidcs').html($('.uitemc_umi.dsp_n'))
			$('.uitemc_umidcs .uitemc_umi').removeClass('dsp_n')
		}
	}


	$('.uitemc_umidl').on('click', function () { 
		$('.uitemc_umid').toggleClass('uitemc_umid_act')
	})


	// скрол
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






	// sign up
	$('.btn_sign_up').on('click', function() {

		// form
		btn = $(this)
		phone = $('.phone')
		code = $('.code')
		sname = $('.name')
		password = $('.password')

		// 
		if (btn.attr('data-type') == 'phone') {
			if (phone.attr('data-sel') != 1) mess('Cіз телефен номеріңізді жазбапсыз')
			else {
				$.ajax({
					url: "/user/get.php?sign_up_phone",
					type: "POST",
					dataType: "html",
					data: ({ phone: phone.attr('data-val') }),
					success: function(data){
						if (data == 'phone') mess('Cіз базада тіркелмегенсіз, админмен байланысып көріңіз!')
						else if (data == 'password') mess('Cіз платформаға туркелгенсіз. <a href="sign_in.php">Кіру</a>')
						else if (data == 'code') {
							phone.attr('disabled', 'true')
							code.parent().removeClass('dsp_n')
							btn.attr('data-type', 'code')
						} else console.log(data)
					},
					beforeSend: function(){},
					error: function(data){console.log(data)}
				})
			}
		} else if (btn.attr('data-type') == 'code') {
			if (code.attr('data-sel') != 1) mess('Cіз сандарды жазбапсыз')
			else {
				$.ajax({
					url: "/user/get.php?sign_up_code",
					type: "POST",
					dataType: "html",
					data: ({
						phone: phone.attr('data-val'),
						code: code.attr('data-val')
					}),
					success: function(data){
						if (data == 'yes') {
							code.attr('disabled', 'true')
							sname.parent().removeClass('dsp_n')
							password.parent().removeClass('dsp_n')
							btn.attr('data-type', 'final')
						} else if (data == 'none') mess('Cіз жазған код қате, қайта жазып көріңіз')
						else console.log(data)
					},
					beforeSend: function(){},
					error: function(data){console.log(data)}
				})
			}
		} else if (btn.attr('data-type') == 'final') {
			if (sname.attr('data-sel') != 1 || password.attr('data-sel') != 1) mess('Форманы толық толтырыңыз')
			else {
				$.ajax({
					url: "/user/get.php?sign_up_final",
					type: "POST",
					dataType: "html",
					data: ({
						name: sname.attr('data-val'),
						password: password.attr('data-val')
					}),
					success: function(data){
						if (data == 'yes') location.reload();
						else console.log(data)
					},
					beforeSend: function(){},
					error: function(data){console.log(data)}
				})
			}
		}
	});


	// sign up mail
	$('.btn_sign_up_mail').on('click', function() {

		// form
		btn = $(this)
		smail = $('.smail')
		code = $('.code')
		sname = $('.name')
		password = $('.password')

		// 
		if (btn.attr('data-type') == 'mail') {
			if (smail.attr('data-sel') != 1) mess('Cіз телефен номеріңізді жазбапсыз')
			else {
				$.ajax({
					url: "/user/get.php?sign_up_mail",
					type: "POST",
					dataType: "html",
					data: ({ smail: smail.attr('data-val') }),
					success: function(data){
						if (data == 'mail') mess('Cіз базада тіркелмегенсіз, админмен байланысып көріңіз!')
						else if (data == 'password') mess('Cіз платформаға туркелгенсіз. <a href="sign_in.php">Кіру</a>')
						else if (data == 'code') {
							smail.attr('disabled', 'true')
							code.parent().removeClass('dsp_n')
							btn.attr('data-type', 'code')
						} else console.log(data)
					},
					beforeSend: function(){},
					error: function(data){console.log(data)}
				})
			}
		} else if (btn.attr('data-type') == 'code') {
			if (code.attr('data-sel') != 1) mess('Cіз сандарды жазбапсыз')
			else {
				$.ajax({
					url: "/user/get.php?sign_up_mail_code",
					type: "POST",
					dataType: "html",
					data: ({
						smail: smail.attr('data-val'),
						code: code.attr('data-val')
					}),
					success: function(data){
						if (data == 'yes') {
							code.attr('disabled', 'true')
							sname.parent().removeClass('dsp_n')
							password.parent().removeClass('dsp_n')
							btn.attr('data-type', 'final')
						} else if (data == 'none') mess('Cіз жазған код қате, қайта жазып көріңіз')
						else console.log(data)
					},
					beforeSend: function(){},
					error: function(data){console.log(data)}
				})
			}
		} else if (btn.attr('data-type') == 'final') {
			if (sname.attr('data-sel') != 1 || password.attr('data-sel') != 1) mess('Форманы толық толтырыңыз')
			else {
				$.ajax({
					url: "/user/get.php?sign_up_mail_final",
					type: "POST",
					dataType: "html",
					data: ({
						name: sname.attr('data-val'),
						password: password.attr('data-val')
					}),
					success: function(data){
						if (data == 'yes') location.reload();
						else console.log(data)
					},
					beforeSend: function(){},
					error: function(data){console.log(data)}
				})
			}
		}
	});




	 


	// sign in
	$('.btn_sign_in').on('click', function() {
		phone = $('.phone')
		password = $('.password')

		if (phone.attr('data-sel') != 1 || password.attr('data-sel') != 1) {
			if (phone.attr('data-sel') != 1) mess('Cіз телефен номеріңізді жазбапсыз')
			else if (password.attr('data-sel') != 1) mess('Cіз кілт сөзді жазбапсыз')
		} else {
			$.ajax({
				url: "/user/get.php?phone",
				type: "POST",
				dataType: "html",
				data: ({ 
					phone: phone.attr('data-val'),
					password: password.attr('data-val')
				}),
				success: function(data){
					if (data == 'yes') location.reload();
					else if (data == 'code') mess('Сізді базадан таптым, бірақ тіркелмегенсіз! <br> <a href="sign_up.php">Тіркелу</a>')
					else if (data == 'password') {
						mess('Cіз кілт сөзді қате теріп жатсыз')
						$('.si_blc_bn').removeClass('dsp_n')
					}
					else if (data == 'phone') mess('Cіз базада тіркелмегенсіз, админмен байланысып көріңіз!')
					else console.log(data)
				},
				beforeSend: function(){},
				error: function(data){ console.log(data) }
			})
		}
	});

	// sign in
	$('.btn_sign_in_mail').on('click', function() {
		smail = $('.smail')
		password = $('.password')

		if (smail.attr('data-sel') != 1 || password.attr('data-sel') != 1) {
			if (smail.attr('data-sel') != 1) mess('Cіз почтаңызды жазбапсыз')
			else if (password.attr('data-sel') != 1) mess('Cіз кілт сөзді жазбапсыз')
		} else {
			$.ajax({
				url: "/user/get.php?smail",
				type: "POST",
				dataType: "html",
				data: ({ 
					smail: smail.attr('data-val'),
					password: password.attr('data-val')
				}),
				success: function(data){
					if (data == 'yes') location.reload();
					else if (data == 'code') mess('Сізді базадан таптым, бірақ тіркелмегенсіз! <br> <a href="sign_up_mail.php">Тіркелу</a>')
					else if (data == 'password') {
						mess('Cіз кілт сөзді қате теріп жатсыз')
						$('.si_blc_bn').removeClass('dsp_n')
					}
					else if (data == 'mail') mess('Cіз базада тіркелмегенсіз, админмен байланысып көріңіз!')
					else console.log(data)
				},
				beforeSend: function(){},
				error: function(data){ console.log(data) }
			})
		}
	});



	// btn_sign_reset
	$('.btn_sign_reset').on('click', function() {
		btn = $(this)
		phone = $('.phone')
		code = $('.code')
		password = $('.password')

		// 
		if (btn.attr('data-type') == 'phone') {
			if (phone.attr('data-sel') != 1) mess('Cіз телефен номеріңізді жазбапсыз')
			else {
				$.ajax({
					url: "/user/get.php?reset_phone",
					type: "POST",
					dataType: "html",
					data: ({ phone: phone.attr('data-val') }),
					success: function(data){
						if (data == 'phone') mess('Cіз базада тіркелмегенсіз, админмен байланысып көріңіз!')
						else if (data == 'code') {
							phone.attr('disabled', 'true')
							code.parent().removeClass('dsp_n')
							btn.attr('data-type', 'code')
						} else console.log(data)
					},
					beforeSend: function(){},
					error: function(data){console.log(data)}
				})
			}
		} else if (btn.attr('data-type') == 'code') {
			if (code.attr('data-sel') != 1) mess('Cіз сандарды жазбапсыз')
			else {
				$.ajax({
					url: "/user/get.php?reset_code",
					type: "POST",
					dataType: "html",
					data: ({
						phone: phone.attr('data-val'),
						code: code.attr('data-val')
					}),
					success: function(data){
						if (data == 'yes') {
							code.attr('disabled', 'true')
							password.parent().removeClass('dsp_n')
							btn.attr('data-type', 'final')
						} else if (data == 'none') mess('Cіз жазған код қате, қайта жазып көріңіз')
						else console.log(data)
					},
					beforeSend: function(){},
					error: function(data){console.log(data)}
				})
			}
		} else if (btn.attr('data-type') == 'final') {
			if (password.attr('data-sel') != 1) mess('Форманы толық толтырыңыз')
			else {
				$.ajax({
					url: "/user/get.php?reset_final",
					type: "POST",
					dataType: "html",
					data: ({ password: password.attr('data-val') }),
					success: function(data){
						if (data == 'yes') location.reload();
						else console.log(data)
					},
					beforeSend: function(){},
					error: function(data){console.log(data)}
				})
			}
		}
	});










	// btn_pass_reset
	$('.btn_pass_reset').on('click', function() {
		
		// form
		this_btn = $(this)
		btn = $('.btn_sign_in')
		login = $('.login')
		password = $('.password')
		code = $('.code')
		
		// block
		cn_p = $('.usign_p')
		cn_h = $('.usign_h')
		cn_reset = $('.cn_reset')
		cn_reset_time = $('.cn_reset_time')

		$.ajax({
			url: "/user/get.php?pass_reset",
			type: "POST",
			dataType: "html",
			data: ({login: login.attr('data-val')}),
			success: function(data){
				if (data == 'yes') {
					password.parent().addClass('dsp_n')
					code.parent().removeClass('dsp_n')
					cn_reset.addClass('dsp_n')
					cn_p.html(cn_p.attr('data-reset-pass'))
					btn.attr('data-type', 'reset-pass')
				} else {console.log(data)}
				console.log(data);
			},
			beforeSend: function(){},
			error: function(data){console.log(data)}
		})
	});
















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






	// home work
	$('.btn_addu_work').on('click', function () {

		btn = $(this)
		txt = $('.inp_form')

		if (txt.val() == '') mess('Жазуды ұмыттыңыз')
		else {
			$.ajax({
				url: "/user/homework/get.php?add_work",
				type: "POST",
				dataType: "html",
				data: ({ 
					id: btn.attr('data-work-id'),
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












}) // end jquery