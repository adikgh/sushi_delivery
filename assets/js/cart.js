$(document).ready(function() {



   // $('.carts_p').offset().top
   // console.log($('.carts_p').offset().top);
   // console.log(cart8_top);


   cart8_top = $('.carts_p').offset().top - $(window).height()
   scroll = $(window).scrollTop()
	if (scroll > cart8_top) $('.carts_bh').addClass('pmenu_hide')
	else $('.carts_bh').removeClass('pmenu_hide')
	$(window).scroll(function() {
		scroll = $(window).scrollTop()
		if (scroll > cart8_top) $('.carts_bh').addClass('pmenu_hide')
		else $('.carts_bh').removeClass('pmenu_hide')
	})




   // 
   $('.form_btn_c .form_btn_i').click(function(){
      if ($(this).hasClass('form_btn_act') == true) $(this).siblings('.form_btn_i').removeClass('form_btn_act');
      else {
         $(this).siblings('.form_btn_i').removeClass('form_btn_act');
         $(this).addClass('form_btn_act');
      }
	})
   $('.delivery_method .form_btn_i').click(function(){
		if ($('.form_cso1c:first-child').hasClass('dsp_n') == true) {
			$('.form_cso1c:first-child').removeClass('dsp_n')
			$('.form_cso1c:last-child').addClass('dsp_n')
		} else {
			$('.form_cso1c:first-child').addClass('dsp_n')
			$('.form_cso1c:last-child').removeClass('dsp_n')
		}
	})


   // 
   $('.delivery_btn1').click(function () { 
      $('.delivery1').removeClass('delivery_act')
      $('.delivery2').addClass('delivery_act')
      
      $('.delivery1').addClass('delivery_true')
   })
   $('.delivery_back1').click(function () { 
      $('.form_c').removeClass('delivery_act')
      $('.delivery1').addClass('delivery_act')
   })



   // 
   $('.delivery_btn2').click(function () { 
      $('.delivery2').removeClass('delivery_act')
      $('.delivery3').addClass('delivery_act')

      $('.delivery2').addClass('delivery_true')
   })
   $('.delivery_back2').click(function () { 
      $('.form_c').removeClass('delivery_act')
      $('.delivery2').addClass('delivery_act')
   })



   // 
   $('html').on('click', '.delivery_order', function() {
		btn = $(this)
      sum = btn.attr('data-sum')
      sname = $('.name').attr('data-val')
      phone = $('.phone').attr('data-val')
      delivery_method = $('.delivery_method .form_btn_act').attr('data-val')
      payment_method = $('.payment_method .form_btn_act').attr('data-val')

      // console.log(payment_method);

		$.ajax({
			url: "/shoppingcart/get.php?add_order",
			type: "POST",
			dataType: "html",
			data: ({ 
            sum: sum,
            name: sname,
            phone: phone,
            delivery_method: delivery_method,
            payment_method: payment_method,
         }),
         beforeSend: function(){ },
         error: function(data){ console.log(data) },
			success: function(data){
				if (data == 'yes') location.href = '/';
            else console.log(data);
			},
		})
	})




})