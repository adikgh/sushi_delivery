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

            <div class="uc_ui uc_ui2 cashbox_add" data-oid="<?=$oid?>" data-id="<?=$product_d['id']?>" data-item-id="<?=$pitem_d['id']?>" data-quantity="<?=$quantity?>">
               <div class="uc_uil">
                  <div class="uc_ui_number"><?=$number?></div>
                  <div class="uc_uiln">
                     <div class="uc_ui_img lazy_img" data-src="https://lighterior.kz/assets/uploads/products/<?=$pitem_d['img']?>">
                        <?=($pitem_d['img']!=null?'':'<i class="fal fa-box"></i>')?>
                     </div>
                     <div class="uc_uinu">
                        <div class="uc_ui_name"><?=$product_d['name_ru']?></div>
                        <? if ($pitem_d['color_id'] || $pitem_d['size_id'] || $pitem_d['barcode']): ?>
                           <div class="uc_ui_cont">
                              <? if ($pitem_d['barcode']): ?> <div><?=$pitem_d['barcode']?></div> <? endif ?>
                              <? if ($pitem_d['color_id']): ?> <div><?=(product::pr_color($pitem_d['color_id']))['name_ru']?></div> <? endif ?>
                              <? if ($pitem_d['size_id']): ?> <div><?=(product::pr_size($pitem_d['size_id']))['name']?></div> <? endif ?>
                           </div>
                        <? endif ?>
                     </div>
                  </div>
                  <div class="uc_uin_other"><?=$pitem_d['article']?></div>
                  <div class="uc_uin_other fr_price"><?=$pitem_d['price']?> тг</div>
                  <div class="uc_uin_other fr_number3"><?=$quantity?> шт</div>
               </div>
            </div>

         <? endwhile ?>

      <? else: ?>

         <? $product = db::query("select * from product where (name_kz like '%$search%') or (name_ru like '%$search%') order by ins_dt desc limit 18"); ?>
         <? while ($product_d = mysqli_fetch_assoc($product)): ?>
            <? $number++; $product_id = $product_d['id']; ?>
            <? $pitem = db::query("select * from product_item where product_id = '$product_id'"); ?>
            <? while ($pitem_d = mysqli_fetch_assoc($pitem)): ?>
               <? $quantity = product::pr_item_quantity($pitem_d['id']); ?>

               <div class="uc_ui uc_ui2 cashbox_add" data-oid="<?=$oid?>" data-id="<?=$product_d['id']?>" data-item-id="<?=$pitem_d['id']?>" data-quantity="<?=$quantity?>">
                  <div class="uc_uil">
                     <div class="uc_ui_number"><?=$number?></div>
                     <div class="uc_uiln">
                        <div class="uc_ui_img lazy_img" data-src="https://lighterior.kz/assets/uploads/products/<?=$pitem_d['img']?>">
                           <?=($pitem_d['img']!=null?'':'<i class="fal fa-box"></i>')?>
                        </div>
                        <div class="uc_uinu">
                           <div class="uc_ui_name"><?=$product_d['name_ru']?></div>
                           <? if ($pitem_d['color_id'] || $pitem_d['size_id'] || $pitem_d['barcode']): ?>
                              <div class="uc_ui_cont">
                                 <? if ($pitem_d['barcode']): ?> <div><?=$pitem_d['barcode']?></div> <? endif ?>
                                 <? if ($pitem_d['color_id']): ?> <div><?=(product::pr_color($pitem_d['color_id']))['name_ru']?></div> <? endif ?>
                                 <? if ($pitem_d['size_id']): ?> <div><?=(product::pr_size($pitem_d['size_id']))['name']?></div> <? endif ?>
                              </div>
                           <? endif ?>
                        </div>
                     </div>
                     <div class="uc_uin_other"><?=$pitem_d['article']?></div>
                     <div class="uc_uin_other fr_price"><?=$pitem_d['price']?> тг</div>
                     <div class="uc_uin_other fr_number3"><?=$quantity?> шт</div>
                  </div>
               </div>
            <? endwhile ?>
         <? endwhile ?>

      <? endif ?>

		<? exit(); ?>
	<? endif ?>