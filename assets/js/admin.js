// start jquery
$(document).ready(function() {








   // add user
	$('.add_user_btn').click(function(){
		$('.add_user').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
	})
	$('.add_user_back').click(function(){
		$('.add_user').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})
	$('.add_user_send').on('click', function(){
		var phone = $('.phone')
		var name = $('.name')
		$.ajax({
			url: "/users/get.php?add_user",
			type: "POST",
			dataType: "html",
			data: ({
				phone : phone.attr('data-val'),
				name : name.attr('data-val'),
			}),
			success: function(data){
				if (data == 'add') location.reload();
				else if (data == 'yes') mess('Бұл адамда уже доступ бар')
				else console.log(data)
			},
			beforeSend: function(){},
			error: function(data){console.log(data)}
		})
	})



	// add user
	$('.edit_user_btn').click(function(){
		$('.edit_user').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');


		$.ajax({
			url: "/users/edit.php?user_edit",
			type: "POST",
			dataType: "html",
			data: ({ id: $(this).attr('data-id') }),
			success: function(data){
				$('.edit_clp').html(data)
				$('.fr_phone').mask('8 (000) 000-00-00');
				// console.log(data)
			},
			beforeSend: function(){ },
			error: function(data){ console.log(data) }
		})
	})
	$('.edit_user_back').click(function(){
		$('.edit_user').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})
	$('html').on('click', '.edit_user_send', function(){
		var id = $(this)
		var name = $('.edit_name')
		var phone = $('.edit_phone')
		$.ajax({
			url: "/users/get.php?edit_user",
			type: "POST",
			dataType: "html",
			data: ({
				id : id.attr('data-id'),
				phone : phone.attr('data-val'),
				name : name.attr('data-val'),
			}),
			success: function(data){
				if (data == 'yes') location.reload();
				else console.log(data)
			},
			beforeSend: function(){},
			error: function(data){console.log(data)}
		})
	})

	



	


	// view pass
	$('html').on('click', '.on_superv3', function() {
		$.ajax({
			url: "/users/get.php?on_superv=6",
			type: "POST",
			dataType: "html",
			data: ({ id : $(this).attr('data-id'), }),
			success: function(data){
				if (data == 'yes') location.reload();
				else console.log(data)
			},
			beforeSend: function(){ },
			error: function(data){ console.log(data) }
		})
	})
	$('html').on('click', '.on_superv6', function() {
		$.ajax({
			url: "/users/get.php?on_superv=3",
			type: "POST",
			dataType: "html",
			data: ({ id : $(this).attr('data-id'), }),
			success: function(data){
				if (data == 'yes') location.reload();
				else console.log(data)
			},
			beforeSend: function(){ },
			error: function(data){ console.log(data) }
		})
	})









	// view pass
	$('html').on('click', '.copy_pass', function() {
      copytext('Пароль: ' + $(this).parents('.sel_id').data('pass'))
      $('.set_user').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})




   
	// 
	$('html').on('click', '.pass_ress', function() {
		btn = $(this)
		$.ajax({
			url: "/admin/get.php?pass_ress",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id') }),
			success: function(data){
				if (data == 'yes') copytext('Cіздің логин: ' + btn.attr('data-login') + ' Пароль: 123456')
				else console.log(data)
			},
			beforeSend: function(){ },
			error: function(data){ console.log(data) }
		})
	})







   // user del
   $('html').on('click', '.user_del', function(){
      btn = $(this)
      id = btn.parents('.sel_id').data('id')
      $.ajax({
         url: "/users/get.php?user_del",
         type: "POST",
         dataType: "html",
         data: ({ id:id }),
         success: function(data){
            if (data == 'yes') {
               if ($(window).width() < 501) location.reload()
               else btn.parents('.uc_ui').remove()
               mess('Өшірілді')
            }
            console.log(data)
         },
         beforeSend: function(){ },
         error: function(data){ console.log(data) }
      })
   })


 

   






   // sms send
   $('.sms_send').on('click', function(){
      var id = $(this).attr('data-id')
      $.ajax({
         url: "/admin/get.php?sms_send",
         type: "POST",
         dataType: "html",
         data: ({id:id}),
         success: function(data){
            if (data == 'yes') {
               mess('CMC жиберілді')
            } else {console.log(data)}
         },
         beforeSend: function(){
            mess('Жіберілуде')
         },
         error: function(data){console.log(data)}
      })
   })

	






	// cours add block
	$('.company_edit_pop').click(function(){
		$('.company_edit_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
	})
	$('.company_edit_back').click(function(){
		$('.company_edit_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})
	$('.btn_company_edit').click(function () {
		if ($('.company_name').val().length <= 2) mess('Атыңызды толтырыңыз')
		else {
			$.ajax({
				url: "/admin/get.php?company_edit",
				type: "POST",
				dataType: "html",
				data: ({
					name: $('.company_name').attr('data-val'),
					phone: $('.company_phone').attr('data-val'), phone_alt: $('.company_phone').val(),
					whatsapp: $('.company_whatsapp').attr('data-val'), whatsapp_alt: $('.company_whatsapp').val(),
					instagram: $('.company_instagram').attr('data-val'), telegram: $('.company_telegram').attr('data-val'), youtube: $('.company_youtube').attr('data-val'), 
					metrika: $('.company_metrika').attr('data-val'), pixel: $('.company_pixel').attr('data-val'),
				}),
				success: function(data){
					if (data == 'yes') {
						mess('Cәтті сақталды!')
						$('.company_edit_block').removeClass('pop_bl_act');
						setTimeout(function() { location.reload(); }, 500);
					} else console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ console.log(data) }
			})
		}
	})
















}) // end jquery