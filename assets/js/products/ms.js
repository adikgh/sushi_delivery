   // add quantity
	$('.product_quantity_add_pop').click(function(){
		$('.product_quantity_add_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');

      id = $(this).data('id')
      $('.product_quantity_add').attr('data-id', id)

      $.ajax({
         url: "/admin/products/get.php?quantity_sel",
         type: "POST",
         dataType: "html",
         data: ({ id: id, }),
         success: function(data){
            if (data != 'none') {
               $('.form_table').parent().removeClass('dsp_n');
               $('.form_table_h').after(data);
            } else console.log(data);
         },
         beforeSend: function(){ },
         error: function(data){ mess('Ошибка..') }
      })
	})
	$('.product_quantity_add_back').click(function(){
		$('.product_quantity_add_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
      $('.form_table_i').remove();
	})

   // 
   $('.quantity_add').click(function() {
      id = $('.product_quantity_add').data('id')
      if ($('.quantity').data('val') != '') {
         $.ajax({
            url: "/admin/products/get.php?quantity_add",
            type: "POST",
            dataType: "html",
            data: ({
               id: id, color: $('.color').attr('data-val'),
               size: $('.size').attr('data-val'),
               type: $('.type').attr('data-val'),
               quantity: $('.quantity').attr('data-val'),
            }),
            success: function(data){
               if (data != 'none') {
                  $('.form_table').parent().removeClass('dsp_n');
                  $('.form_table_i').remove();
                  $('.form_table_h').after(data);
               } else console.log(data);
            },
            beforeSend: function(){ },
            error: function(data){ mess('Ошибка..') }
         })

      } else console.log('Тандау');

         // var color = '<div class="form_table_ii">' + $('.color').html() + '</div>'; $('.color').html($('.color').data('txt')); $('.color').data('val', '');
         // var size = '<div class="form_table_ii">' + $('.size').html() + '</div>'; $('.size').html($('.size').data('txt')); $('.size').data('val', '');
         // var type = '<div class="form_table_ii">' + $('.type').html() + '</div>'; $('.type').html($('.type').data('txt')); $('.type').data('val', '');
         // var quantity = '<div class="form_table_p">' + $('.quantity').val() + '</div>'; 
         // var txt = '<div class="form_table_i"><div class="form_table_c">' + color + size + type + '</div>' + quantity + '</div>'
         // $('.form_table_h').after(txt);

   });

   $('.product_quantity_add').on('click', function() {
		// var name = $('.name'), catalog = $('.catalog')
		// var manufacturer = $('.manufacturer'), file = $('.file')
		// var purchase_price = $('.purchase_price'), price = $('.price')
		// var discount_price = $('.discount_price')
		
		// if (name.attr('data-sel') != 1) mess('Введите свой данный')
		// else {
		// 	$.ajax({
		// 		url: "/admin/products/get.php?product_add",
		// 		type: "POST",
		// 		dataType: "html",
		// 		data: ({
		// 			name: name.val(), catalog: catalog.data('val'),
		// 			manufacturer: manufacturer.val(), file: file.data('val'),
		// 			purchase_price: purchase_price.data('val'), price: price.data('val'),
		// 			discount_price: discount_price.data('val'),
		// 		}),
		// 		success: function(data){
		// 			if (data == 'yes') mess('Успешно')
		// 			else mess('Ошибка!'); console.log(data);
		// 		},
		// 		beforeSend: function(){ mess('Отправка..') },
		// 		error: function(data){ mess('Ошибка..') }
		// 	})
		// }
	})