// start jquery
$(document).ready(function() {

    $('html').on('input', '.btype_rask', function () {
        btn = $(this)
        btype_start = Number(btn.parent().siblings('.btype_start').attr('data-start'))
        sum = Number(btn.attr('data-val'))

        $(this).parent().siblings('.btype_kaspi').html((btype_start - sum) + ' тг')

        btn.parent().siblings('.btype_start').attr('data-rask', sum)

        // $('.cashbox_pay_btotol_c').attr('data-val', delivery + sum)
        // $('.cashbox_pay_btotol_c').html((delivery + sum) + ' тг')
        // $('.btype_qr input').val(delivery + sum)
        // $('.btype_qr input').attr('data-val', delivery + sum)
        // $('.cashbox_pay_bsemt').html((delivery + sum) + ' тг')

        // console.log(btype_start);
        // console.log(sum);

        // all_sm = 0;
        // $('.btype_rask').each(function() {
        //     all_sm = all_sm + Number($(this).attr('data-val'))
        // })
        // $('.or_rask').html(all_sm + ' тг')

    })
    
    $('html').on('input', '.btype_cash', function () {
        btn = $(this)
        btype_start = Number(btn.parent().siblings('.btype_start').attr('data-start'))
        btype_rask = Number(btn.parent().siblings('.btype_start').attr('data-rask'))
        sum = Number(btn.attr('data-val'))

        $(this).parent().siblings('.btype_kaspi').html((btype_start - sum - btype_rask) + ' тг')
    })

}) // end jquery