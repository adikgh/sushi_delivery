<?php include "../config/core.php"; ?>

   <!--  -->
   <? if (isset($_GET['product_search'])): ?>
		<? $search = strip_tags($_POST['result']); ?>
		<? $oid = strip_tags($_POST['oid']); ?>

      <? $pitem = db::query("select * from product_item where (article like '%$search%') or (barcode like '%$search%') order by ins_dt desc limit 18"); ?>
      <? if (mysqli_num_rows($pitem)): ?>

         <? while ($pitem_d = mysqli_fetch_assoc($pitem)): ?>
            <? $number++; $product_d = product::product($pitem_d['product_id']); ?>
            <? $quantity = product::pr_item_quantity($pitem_d['id']); ?>

            <div class="tb_con cashbox_add" data-oid="<?=$oid?>" data-id="<?=$product_d['id']?>" data-item-id="<?=$pitem_d['id']?>" data-quantity="<?=$quantity?>">
               <div class="tb_con_n"><?=$number?></div>
               <div class="tb_con_icon lazy_img" data-src="https://lighterior.kz/assets/uploads/products/<?=$pitem_d['img']?>">
                  <?=($pitem_d['img']!=null?'':'<i class="fal fa-box"></i>')?>
               </div>
               <div class="tb_con_name"><?=$product_d['name_ru']?></div>
               <div class="tb_con_other tb_con_code">
                  <? if ($pitem_d['article']): ?> <div class="tb_con_code1"><?=$pitem_d['article']?></div> <? endif ?>
                  <? if ($pitem_d['barcode']): ?> <div class="tb_con_code2"><?=$pitem_d['barcode']?></div> <? endif ?>
               </div>
               <div class="tb_con_other"><?=product::pr_color($pitem_d['color_id'])['name_ru']?></div>
               <div class="tb_con_other"><?=product::pr_size($pitem_d['size_id'])['name']?></div>
               <div class="tb_con_other fr_price"><?=$pitem_d['price']?> тг</div>
               <div class="tb_con_other fr_number3"><?=$quantity?> шт</div>
            </div>

         <? endwhile ?>

      <? else: ?>

         <? $product = db::query("select * from product where (name_kz like '%$search%') or (name_ru like '%$search%') order by ins_dt desc limit 10"); ?>
         <? while ($product_d = mysqli_fetch_assoc($product)): ?>
            <? $product_id = $product_d['id']; ?>
            <? $pitem = db::query("select * from product_item where product_id = '$product_id'"); ?>
            <? while ($pitem_d = mysqli_fetch_assoc($pitem)): ?>
               <? $number++; $quantity = product::pr_item_quantity($pitem_d['id']); ?>
               
               <div class="tb_con cashbox_add" data-oid="<?=$oid?>" data-id="<?=$product_d['id']?>" data-item-id="<?=$pitem_d['id']?>" data-quantity="<?=$quantity?>">
                  <div class="tb_con_n"><?=$number?></div>
                  <div class="tb_con_icon lazy_img" data-src="https://lighterior.kz/assets/uploads/products/<?=$pitem_d['img']?>">
                     <?=($pitem_d['img']!=null?'':'<i class="fal fa-box"></i>')?>
                  </div>
                  <div class="tb_con_name"><?=$product_d['name_ru']?></div>
                  <div class="tb_con_other tb_con_code">
                     <? if ($pitem_d['article']): ?> <div class="tb_con_code1"><?=$pitem_d['article']?></div> <? endif ?>
                     <? if ($pitem_d['barcode']): ?> <div class="tb_con_code2"><?=$pitem_d['barcode']?></div> <? endif ?>
                  </div>
                  <div class="tb_con_other"><?=product::pr_color($pitem_d['color_id'])['name_ru']?></div>
                  <div class="tb_con_other"><?=product::pr_size($pitem_d['size_id'])['name']?></div>
                  <div class="tb_con_other fr_price"><?=$pitem_d['price']?> тг</div>
                  <div class="tb_con_other fr_number3"><?=$quantity?> шт</div>
               </div>

            <? endwhile ?>
         <? endwhile ?>

      <? endif ?>

		<? exit(); ?>
	<? endif ?>