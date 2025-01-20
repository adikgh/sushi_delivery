<? include "../config/core.php";

	// 
	if (!$user_id) header('location: /');

   $order_id = $_GET['id'];
   $type = $_GET['type'];

   // filter user all
	$orders_all = db::query("select * from product_item where arh = 0");
	$page_result = mysqli_num_rows($orders_all);

   // page number
   $page = 1; if ($_GET['page'] && is_int(intval($_GET['page']))) $page = $_GET['page'];
   $page_age = 30;
   $page_all = ceil($page_result / $page_age);
   if ($page > $page_all) $page = $page_all;
   $page_start = ($page - 1) * $page_age;
   $number = $page_start;

   // filter cours
   $orders = db::query("select * from product_item where arh = 0 order by ins_dt desc limit $page_start, $page_age");


	// site setting
	$menu_name = 'products';
	// $pod_menu_name = 'list';
	$css = ['orders'];
	$js = ['orders'];
?>
<? include "../block/header.php"; ?>

	<div class="">
		<div class="bl_c">

         <!--  -->
         <!-- <div class="atops">
            <div class="atops_i atops_bk atops_clc"><i class="fal fa-long-arrow-left"></i></div>
            <a class="atops_i atops_clc">Продажи</a>
            <div class="atops_i"><?=$order_id?></div>
         </div> -->

			<div class="uc_u">
				<div class="uc_us">
					<div class="form_im uc_usn">
						<input type="text" placeholder="Поиск" class="sub_user_search_in">
						<i class="fal fa-search form_icon"></i>
					</div>
				</div>
				<div class="uc_uh">
					<div class="uc_uh2">
                  <div class="uc_uh_number">#</div>
						<div class="uc_uh_name">Наименование</div>
						<div class="uc_uh_other">Артикул</div>
						<div class="uc_uh_other">Цвет</div>
						<div class="uc_uh_other">Размер</div>
						<div class="uc_uh_other">Количество</div>
					</div>
               <!-- <div class="uc_uh_cn"></div> -->
				</div>
				<div class="uc_uc">
					<? if (mysqli_num_rows($orders)): ?>
						<? while ($item_d = mysqli_fetch_assoc($orders)): ?>
							<? $pr_d = product::product($item_d['product_id']); ?>
							<? $qs = product::pr_item_quantity($item_d['id']); ?>
							<? $number++; ?>

							<div class="uc_ui uc_ui2">
                        <div class="uc_uil">
                           <div class="uc_ui_number"><?=$number?></div>
                           <div class="uc_uiln" href="#/products/item/?id=<?=$pr_d['id']?>">
                              <!-- <div class="uc_ui_img lazy_img" data-src="https://lighterior.kz/assets/uploads/products/<?=product::product_img($pr_d['id'])?>"><?=(product::product_img($pr_d['id'])!=null?'':'<i class="fal fa-box"></i>')?></div> -->
                              <div class="uc_uinu">
                                 <div class="uc_ui_name"><?=$pr_d['name_ru']?></div>
                                 <div class="uc_ui_cont">
                                    <div class=""><?=$item_d['barcode']?></div>
                                 </div>
                              </div>
                           </div>
                           <div class="uc_uin_other">
										<div class=""><?=$item_d['article']?></div>
                           </div>
                           <div class="uc_uin_other">
                              <div class=""><?=(product::pr_color($item_d['color_id']))['name_ru']?></div>
                           </div>
                           <div class="uc_uin_other">
                              <div class=""><?=(product::pr_size($item_d['size_id']))['name']?></div>
                           </div>
                           <!-- <div class="uc_uin_other"><?=product::product_warehouses($pr_d['id'])?></div> -->
                           <div class="uc_uin_other fr_number3" pitem_updq_pop cursor_p data-id="<?=$item_id?>"><?=$qs?></div> 
                        </div>
                        <!-- <div class="uc_uin_cn " data-id="<?=$buy_d['id']?>"><i class="fal fa-undo-alt"></i></div> -->
							</div>
						<? endwhile ?>
					
					<? else: ?>
						<div class="ds_nr"><i class="fal fa-ghost"></i><p>НЕТ</p></div>
					<? endif ?>

				</div>
			</div>

			<? if ($page_all > 1): ?>
				<div class="uc_p">
					<? if ($page > 1): ?> <a class="uc_pi" href="?page=<?=$page-1?>"><i class="fal fa-angle-left"></i></a> <? endif ?>
					<a class="uc_pi <?=($page==1?'uc_pi_act':'')?>" href="?page=1">1</a>
					<? for ($pg = 2; $pg < $page_all; $pg++): ?>
						<? if ($pg == $page - 1): ?>
							<? if ($page - 1 != 2): ?> <div class="uc_pi uc_pi_disp">...</div> <? endif ?>
							<a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="?page=<?=$pg?>"><?=$pg?></a>
						<? endif ?>
						<? if ($pg == $page): ?> <a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="?page=<?=$pg?>"><?=$pg?></a> <? endif ?>
						<? if ($pg == $page + 1): ?>
							<a class="uc_pi <?=($page==$pg?'uc_pi_act':'')?>" href="?page=<?=$pg?>"><?=$pg?></a>
							<? if ($page + 1 != $page_all - 1): ?> <div class="uc_pi uc_pi_disp">...</div> <? endif ?>
						<? endif ?>
					<? endfor ?>
					<a class="uc_pi <?=($page==$page_all?'uc_pi_act':'')?>" href="?page=<?=$page_all?>"><?=$page_all?></a>
					<? if ($page < $page_all): ?> <a class="uc_pi" href="?page=<?=$page+1?>"><i class="fal fa-angle-right"></i></a> <? endif ?>
				</div>
			<? endif ?>

		</div>
	</div>

<? include "../block/footer.php"; ?>