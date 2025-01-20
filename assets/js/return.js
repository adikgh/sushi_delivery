// start jquery
$(document).ready(function() {


   // 
   var cash_bl1_lq = new Swiper(".cash_bl1_lq", {
      slidesPerView: 'auto',
      spaceBetween: 20,
   });


	// cashbox_add
	$('html').on('click', '.cashbox_add', function () {
      btn = $(this)
      $.ajax({
         url: "/return/get.php?cashbox_add",
         type: "POST",
         dataType: "html",
         data: ({
            id: btn.data('id'),
            item_id: btn.data('item-id'),
            oid: btn.data('oid'),
         }),
         success: function(data){ 
            if (data == 'yes') location.reload();
            console.log(data);
         },
         beforeSend: function(){ },
         error: function(data){ }
      })
	})


   // cashbox_search
   // $('.cashbox_search').on('input', function() {
   //    inp = $(this)
   //    $.ajax({
   //       url: "/return/get.php?cashbox_search",
   //       type: "POST",
   //       dataType: "html",
   //       data: ({
   //          inp: inp.val(),
   //          oid: inp.data('oid'),
   //       }),
   //       success: function(data){ 
   //          if (data == 'yes') location.reload();
   //          console.log(data);
   //       },
   //       beforeSend: function(){ },
   //       error: function(data){ }
   //    })
   // })

   // cashbox_search
   $('.cashbox_search').on('input', function() {
      if ($('.cashbox_search').val() == '') {
         $('.cash_bl1_l').removeClass('cash_bl1_act')
         $('.cash_bl1_lm').removeClass('dsp_n')
      } else {
         $('.cash_bl1_lm').addClass('dsp_n')
         $('.cash_bl1_l').addClass('cash_bl1_act') 
         $.ajax({
            url: "/return/get.php?cashbox_search",
            type: "POST",
            dataType: "html",
            data: ({
               inp: $('.cashbox_search').val(),
               oid: $('.cashbox_search').data('oid'),
            }),
            success: function(data){ 
               if (data == 'yes') location.reload();
               else if (data == 0) mess('Товар уже не осталось');
               else console.log(data);
            },
            beforeSend: function(){ },
            error: function(data){ }
         })
         $.ajax({
            url: "/return/search.php?product_search",
            type: "POST",
            dataType: "html",
            data: ({ 
               result: $('.cashbox_search').val(),
               oid: $('.cashbox_search').data('oid'),
            }),
            success: function(data){
               $('.cash_bl1_lsr .uc_uc').html(data)
               $('.lazy_img').lazy({effect:"fadeIn", effectTime:300, threshold:0})
               // console.log(data)
            },
            beforeSend: function(){ },
            error: function(data){ }
         })
      }
   })


	// cashbox_remove
	$('.cashbox_remove').on('click', function () {
		btn = $(this)
      $.ajax({
         url: "/return/get.php?cashbox_remove",
         type: "POST",
         dataType: "html",
         data: ({ id: btn.data('id'), }),
         success: function(data){ 
            if (data == 'yes') location.reload();
            console.log(data);
         },
         beforeSend: function(){ },
         error: function(data){ }
      })
	})

   
   
   // cashbox_pr
	$('html').on('input', '.cashbox_pr', function () {
		btn = $(this)
      sum = btn.attr('data-val') * btn.parents('.uc_ui').attr('data-qn')
      btn.parent().siblings('.cashbox_sum').html(sum + ' тг')

      $.ajax({
         url: "/return/get.php?cashbox_pr",
         type: "POST",
         dataType: "html",
         data: ({
            id: btn.parents('.uc_ui').data('id'),
            pr: btn.attr('data-val'),
         }),
         success: function(data){
            
            total = $('.cashbox_total').attr('data-total') - btn.parents('.uc_ui').attr('data-sum') + sum
            $('.cashbox_total').html(total + ' тг')

            btn.parents('.uc_ui').attr('data-pr', btn.attr('data-val'))
            btn.parents('.uc_ui').attr('data-sum', sum)
            $('.cashbox_total').attr('data-total', total)

            console.log(data);
         },
         beforeSend: function(){ },
         error: function(data){ }
      })
	})


   // cashbox_qn
	$('html').on('input', '.cashbox_qn', function () {
		btn = $(this)
      $.ajax({
         url: "/return/get.php?cashbox_qn",
         type: "POST",
         dataType: "html",
         data: ({ 
            id: btn.parents('.uc_ui').data('id'),
            item_id: btn.parents('.uc_ui').data('item-id'),
            qn: btn.attr('data-val'),
         }),
         success: function(data){ 
            if (data == 'yes') {
               sum = btn.attr('data-val') * btn.parents('.uc_ui').attr('data-pr')
               btn.parent().siblings('.cashbox_sum').html(sum + ' тг')

               total = $('.cashbox_total').attr('data-total') - btn.parents('.uc_ui').attr('data-sum') + sum
               $('.cashbox_total').html(total + ' тг')
   
               btn.parents('.uc_ui').attr('data-qn', btn.attr('data-val'))
               btn.parents('.uc_ui').attr('data-sum', sum)
               $('.cashbox_total').attr('data-total', total)
            } else console.log(data);
            // if (data == 'yes') location.reload();
            // else 
         },
         beforeSend: function(){ },
         error: function(data){ }
      })
	})


   
	// cashbox_pay
	$('.cashbox_pay').on('click', function () {
		btn = $(this)
      $.ajax({
         url: "/return/get.php?cashbox_pay",
         type: "POST",
         dataType: "html",
         data: ({ id: btn.data('id'), }),
         success: function(data){ 
            if (data == 'yes') location.reload();
            console.log(data);
         },
         beforeSend: function(){ },
         error: function(data){ }
      })
	})





}) // end jquery