<? $pitem = db::query("select * from product_item limit 6"); ?>
<? while ($pitem_d = mysqli_fetch_assoc($pitem)): ?>
   <? $product_d = product::product($pitem_d['product_id']); ?>
   <? $quantity = product::pr_item_quantity($pitem_d['id']); ?>
   <div class="bs_wi cashbox_add" data-oid="<?=$cashbox_id?>" data-id="<?=$product_d['id']?>" data-item-id="<?=$pitem_d['id']?>" data-quantity="<?=$quantity?>">
      <div class="bs_wi_img">
         <? if ($pitem_d['img']): ?> <div class="lazy_img" data-src="https://lighterior.kz/assets/uploads/products/<?=$pitem_d['img']?>"></div>
         <? else: ?> <i class="fal fa-box"></i> <? endif ?>
      </div>
      <div class="bs_wi_c">
         <? if ($product_d['name_ru']): ?> <div class="bs_wi_cn"><?=$product_d['name_ru']?></div> <? endif ?>
         <div class="bs_wi_cd">
            <div class="bs_wi_cp"><?=product::product_price($product_d['id'])?> тг</div>
            <div class="bs_wi_cs"><?=$quantity?> шт</div>
         </div>
      </div>
   </div>
<? endwhile ?>