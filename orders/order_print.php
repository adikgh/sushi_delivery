<? include "../config/core.php"; 

    if (@$_GET['orderID']) {
        $orderID = $_GET['orderID'];

        $cashbox = db::query("select * from retail_orders where id = '$orderID'");
        if (mysqli_num_rows($cashbox)) {
            $cashbox_d = mysqli_fetch_assoc($cashbox);
        }
    }


?>


<style>

    html {margin:0; padding:0;}
    body {width:70mm; margin:0; padding:5px; font-size:16px; font-family: Arial, Helvetica, sans-serif;}
    .tr td {padding:3px 0;}
    .tr_title td {border-top:3px solid #000; border-bottom:3px solid #000; text-align:center; font-size:36px; overflow:hidden;}
    .tr_head td {padding:3px 0; border-bottom:1px dashed #000;}
    .tr_border td {border-bottom:1px solid #000;}
    .tr_sep td {padding:0; border-bottom:1px solid #000;}
    .tr_promo td {padding:20px 10px;}

</style>


<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tbody>
        <tr class="tr_title">
            <td colspan="3"><?=($cashbox_d['branch_id']==2?'SUSHIMASTER':'BANZAI')?></td>
        </tr>
        <tr class="tr_head">
            <td colspan="3" align="center"></td>
        </tr>
        <? if ($cashbox_d['preorder_dt']): ?>
            <tr class="tr_title">
                <td colspan="3">ПРЕДЗАКАЗ</td>
            </tr>
            <tr class="tr">
                <td align="left" сolspan="3"><?=$cashbox_d['preorder_dt']?></td>
            </tr>
            <tr class="tr_head">
                <td colspan="3" align="center"></td>
            </tr>
        <? endif ?>
        <? if ($cashbox_d['order_status'] == 2): ?>
            <tr class="tr_title">
                <td colspan="3">СОБОЙ</td>
            </tr>
        <? endif ?>
        <tr class="tr">
            <td colspan="3">
                <br><?=$cashbox_d['upd_dt']?>
            </td>
        </tr>
        <tr class="tr">
            <td colspan="3"><b>Номер заказ: <?=$cashbox_d['number']?></b></td>
        </tr>
        <tr class="tr">
            <td colspan="3"></td>
        </tr>

        <tr class="tr_border">
            <td><br><b>Наименование</b></td>
            <td width="40" align="center"><b>Кол.</b></td>
            <td width="50" align="right"><b>Сумма</b></td>
        </tr>
        
        <? $cashboxp = db::query("select * from retail_orders_products where order_id = '$orderID' order by ins_dt asc"); ?>
        <? while ($sel_d = mysqli_fetch_assoc($cashboxp)): ?>
            <? $product = product::product($sel_d['product_id'])?>
            <tr class="tr" valign="top">
                <td align="left"><?=$product['name_ru']?></td>
                <td align="center"><?=$sel_d['quantity']?></td>
                <td align="right"><?=($sel_d['quantity'] * $sel_d['price'])?></td>
            </tr>
        <? endwhile ?>
            <tr class="tr" valign="top">
                <td align="left">Доставка</td>
                <td align="center"></td>
                <td align="right"><?=$cashbox_d['pay_delivery']?></td>
            </tr>
            <tr class="tr" valign="top">
                <td align="left">Предоплата</td>
                <td align="center"></td>
                <td align="right">- <?=$cashbox_d['pay_qr']?></td>
            </tr>

        <tr class="tr_sep">
            <td colspan="3"></td>
        </tr>
        <tr class="tr_sep">
            <td colspan="3"></td>
        </tr>
        <tr class="tr">
            <td align="left"><b>К ОПЛАТЕ</b></td>
            <td></td>
            <td align="right"><b><?=$cashbox_d['total'] - $cashbox_d['pay_qr']?></b></td>
        </tr>

        <!-- <tr style="height:20px">
            <td></td>
            <td></td>
            <td></td>
        </tr> -->
        <tr class="tr_border">
            <td><br><b>Клиент</b></td>
        </tr>
        <tr class="tr">
            <td align="left" сolspan="3">Номер: <?=$cashbox_d['phone']?></td>
        </tr>
        <tr class="tr">
            <td align="left" сolspan="3">Адрес: <?=$cashbox_d['address']?></td>
        </tr>
        <!-- <tr class="tr">
            <td align="left" сolspan="3">Способ оплаты: </td>
        </tr> -->
        <tr class="tr_promo" valign="middle">
            <td align="center" colspan="3"></td>
        </tr>
        <tr class="tr">
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
    </tbody>
</table>


<script type="text/javascript">
    window.onload = function() {
	    window.print();
    }
</script>