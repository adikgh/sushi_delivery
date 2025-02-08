// start jquery
$(document).ready(function() {

	// lazy img
	$('.lazy_logo').lazy({effect:"fadeIn",effectTime:100,threshold:0})
	$('.lazy_img').lazy({effect:"fadeIn",effectTime:300,threshold:0})
	$('.lazy_bag').lazy({effect:"fadeIn",effectTime:500,threshold:0})
	$('.lazy_c .lazy_img').lazy({
		effect: "fadeIn",
		effectTime: 100,
		threshold: 0,
		appendScroll: $('.lazy_c'),
	})


	setInterval(function () {
		toDate = new Date();
		$('.toDate').html(toDate.getHours() + ":" + toDate.getMinutes())
  	}, 1000);



	// на верх
	$('html').on('click', '.clc_top', function(){$('html, body').animate({scrollTop:0},500)})




	// mask form
	$('.fr_phone').mask('8 (700) 000-00-00');
	$('.fr_phone2').mask('0 (000) 000-00-00');
	$('.fr_code').mask('0000');
	$('.fr_code1').mask('0');
	$('.fr_age').mask('00');
	$('.fr_price').mask('# ##0 тг', {reverse: true});
	$('.fr_number').mask('# ##0', {reverse: true});
	$('.fr_number2').mask('#0', {reverse: true});
	$('.fr_number3').mask('# ##0 шт', {reverse: true});
	

	// input
	$('html').on('input', 'input[type*="text"], input[type*="password"]', function() {
		$(this).attr('data-val', $(this).val())
		if ($(this).attr('data-lenght') <= $(this).val().length) $(this).attr('data-sel', 1)
		else $(this).attr('data-sel',0)
	});
	$('html').on('input', 'input[type*="tel"]', function() {
		var val = $(this).val().replace(/_/g, '').replace(/ /g, '').replace(/-/g, '').replace(/\(/g, '').replace(/\)/g, '').replace(/\+/g, '').replace(/тг/g, '').replace(/шт/g, '').replace(/\./g, '')
		$(this).attr('data-val', val)
		if ($(this).attr('data-lenght') <= val.length) $(this).attr('data-sel', 1)
		else $(this).attr('data-sel',0)
	});
	$('input[type*="url"]').on('input', function(){
		val = $(this).val().replace('https://', '').replace('www.', '').replace('youtube.com/watch?v=', '').replace('youtu.be/', '').replace(/\&.*/, '')
		$(this).attr('data-val', val)
	})

	// password view
	$('html').on('click', '.form_icon_pass', function() {
		if ($(this).siblings('.password').attr('data-eye') == 0) {
			$(this).siblings('.password').attr('type', 'text')
			$(this).siblings('.password').attr('data-eye', '1')
			$(this).addClass('fa-eye')
			$(this).removeClass('fa-eye-slash')
		} else {
			$(this).siblings('.password').attr('type', 'password')
			$(this).siblings('.password').attr('data-eye', '0')
			$(this).removeClass('fa-eye')
			$(this).addClass('fa-eye-slash')
		}
	})


	// select input
	$('html').on('click', '.sel_clc', function() {
		if ($(this).hasClass('form_sel_act') == false) {
			$('.sel_clc').removeClass('form_sel_act')
			$(this).addClass('form_sel_act')
		} else $(this).removeClass('form_sel_act')
	});
	$('html').on('click', '.sel_clc_i .form_im_seli', function() {
		$(this).parent().siblings('input').attr('data-val', '')
		$(this).parent().siblings('input').attr('data-id', $(this).data('val'))
		$(this).parent().siblings('input').val($(this).html())
		$(this).parent().siblings('div.sel_clc').attr('data-val', $(this).data('val'))
		$(this).parent().siblings('div.sel_clc').html($(this).html())
		$(this).parent().siblings('.sel_clc').removeClass('form_sel_act')
	});

	// toggle btn
	$('html').on('click', '.form_im_toggle_btn', function() { 
		if ($(this).hasClass('form_im_toggle_act') == true) $(this).siblings('input').attr('data-val', 0)
		else $(this).siblings('input').attr('data-val', 1)
		$(this).toggleClass('form_im_toggle_act')
	});



	// form - input 
	// lenght
	// $('.form_im input[type*="tel"]').on('input', function(){
	// 	$(this).parent().removeClass('form_pust');
	// 	in_rez = $(this).val().replace(/ /g, '').replace(/\+/g, '').replace(/\)/g, '').replace(/\(/g, '').replace(/-/g, '').replace(/_/g, '')
	// 	if ($(this).attr('data-pr') == '1' && in_rez.length < $(this).attr('data-lenght')) {
	// 		$(this).parent().removeClass('form_pr_y')
	// 		$(this).parent().addClass('form_pr_n')
	// 	} else if (in_rez.length < $(this).attr('data-lenght')) {
	// 		$(this).parent().removeClass('form_pr_y')
	// 	} else {
	// 		$(this).parent().removeClass('form_pr_n')
	// 		$(this).parent().removeClass('form_pr_nm')
	// 		$(this).parent().addClass('form_pr_y')
	// 		$(this).attr('data-pr', '1')
	// 	}
	// })
	// $('.form_im input[type*="text"], input[type*="password"]').on('input', function(){
	// 	$(this).parent().removeClass('form_pust');
	// 	if ($(this).attr('data-pr') == '1' && $(this).val().length <= $(this).attr('data-lenght')) {
	// 		$(this).parent().removeClass('form_pr_y')
	// 		$(this).parent().addClass('form_pr_n')
	// 	} else if ($(this).val().length <= $(this).attr('data-lenght')) {
	// 		$(this).parent().removeClass('form_pr_y')
	// 	} else {
	// 		$(this).parent().removeClass('form_pr_n')
	// 		$(this).parent().removeClass('form_pr_nm')
	// 		$(this).parent().addClass('form_pr_y')
	// 		$(this).attr('data-pr', '1')
	// 	}
	// })

	// // 
	// $('.form_cn input').focus(function() {
	// 	$(this).parent().addClass('form_act');
	// });
	// $('.form_cn input').blur(function(){
	// 	if ($(this).val().length <= 0) {
	// 		$(this).parent().removeClass('form_act');
	// 	}
	// })
	// $('.form_cn input').on('input', function(){
	// 	$(this).parent().removeClass('form_pust');
	// 	$('.form_sms').parent().addClass('dsp_n');
	// })





	//
	// $('.bli_setib1').on('click', function() {
	// 	$('.bl_item').removeClass('bl_item_ac')
	// 	$(this).parents('.bl_item').addClass('bl_item_ac')
	// })










	










}) // end jquery