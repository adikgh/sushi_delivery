<? include "../config/core.php";

	// 
	if (!$user_id) header('location: /');


	// 
	$cashbox = db::query("select * from pr_warehouses_displacement where user_id = '$user_id' and success = 0 order by id desc limit 1");
	if (mysqli_num_rows($cashbox)) {
		$cashbox_d = mysqli_fetch_assoc($cashbox);
		$cashbox_id = $cashbox_d['id'];
	} else {
		$cashbox_id = (mysqli_fetch_assoc(db::query("SELECT max(id) FROM `pr_warehouses_displacement`")))['max(id)'] + 1;
		$ins = db::query("INSERT INTO `pr_warehouses_displacement`(`id`, `user_id`) VALUES ('$cashbox_id', '$user_id')");
	}
	$cashboxp = db::query("select * from pr_warehouses_displacement_product where displacement_id = '$cashbox_id' order by ins_dt desc");
	$number = 0;
	

	// site setting
	$menu_name = 'displacement';
	// $pod_menu_name = 'list';
	$css = ['orders'];
	$js = ['orders', 'products/displacement'];

?>
<? include "../block/header.php"; ?>

	<div class="">
		<div class="bl_c">

			<div class="displacement_n1">
				<div class="form_c displacement_n1c">
					<div class="form_im form_sel from_stock" data-id="<?=$cashbox_id?>">
						<div class="form_span">Со склада:</div>
						<i class="fal fa-warehouse-alt form_icon"></i>
						<? if ($cashbox_d['from_stock']): ?> <div class="form_im_txt sel_clc " data-val="<?=$cashbox_d['from_stock']?>"><?=(product::pr_warehouses($cashbox_d['from_stock']))['name']?></div>
						<? else: ?> <div class="form_im_txt sel_clc " data-val="0">Все</div> <? endif ?>
						<i class="fal fa-caret-down form_icon_sel"></i>
						<div class="form_im_sel sel_clc_i">
							<div class="form_im_seli" data-val="0">Все</div>
							<? $warehouses = db::query("select * from product_warehouses"); ?>
							<? while ($warehouses_d = mysqli_fetch_assoc($warehouses)): ?>
								<div class="form_im_seli" data-val="<?=$warehouses_d['id']?>"><?=$warehouses_d['name']?></div>
							<? endwhile ?>
						</div>
					</div>
					<div class="form_im form_sel in_stock" data-id="<?=$cashbox_id?>">
						<div class="form_span">На склад:</div>
						<i class="fal fa-warehouse-alt form_icon"></i>
						<? if ($cashbox_d['in_stock']): ?> <div class="form_im_txt sel_clc " data-val="<?=$cashbox_d['in_stock']?>"><?=(product::pr_warehouses($cashbox_d['in_stock']))['name']?></div>
						<? else: ?> <div class="form_im_txt sel_clc " data-val="">Выберите склад</div> <? endif ?>
						<i class="fal fa-caret-down form_icon_sel"></i>
						<div class="form_im_sel sel_clc_i">
							<? $warehouses = db::query("select * from product_warehouses"); ?>
							<? while ($warehouses_d = mysqli_fetch_assoc($warehouses)): ?>
								<div class="form_im_seli" data-val="<?=$warehouses_d['id']?>"><?=$warehouses_d['name']?></div>
							<? endwhile ?>
						</div>
					</div>
					<div class="btn displacement_success" data-id="<?=$cashbox_id?>">Переместить</div>
				</div>
			</div>

			<!-- list -->
			<div class="uc_u">
				<div class="uc_us">
					<div class="form_im uc_usn">
						<input type="text" class="cashbox_search" data-id="<?=$cashbox_id?>" placeholder="Поиск" autofocus>
						<i class="fal fa-search form_icon"></i>
					</div>
					<div class="uc_usb"><div class="btn btn_cl">Добавить из списка</div></div>
				</div>
				<div class="uc_uh">
					<div class="uc_uh2">
						<div class="uc_uh_number">#</div>
						<div class="uc_uh_name">Товар и склад</div>
						<div class="uc_uh_other">Все остаток</div>
						<div class="uc_uh_other">Количество</div>
						<div class="uc_uh_other">Остаток (со складе)</div>
						<div class="uc_uh_other">После (на складе)</div>
					</div>
					<div class="uc_uh_cn"></div>
				</div>
				<div class="uc_uc">
					<? if (mysqli_num_rows($cashboxp) != 0): ?>
						<? while ($sel_d = mysqli_fetch_assoc($cashboxp)): ?>
							<? $product_d = product::product($sel_d['product_id']); ?>
							<? $pitem_d = product::pr_item($sel_d['item_id']); ?>
							<? $view_d = product::pr_item_view($sel_d['view_id']); ?>
							<? if (($cashbox_d['all_stock'] && $cashbox_d['in_stock']!=$view_d['warehouses_id']) || (!$cashbox_d['all_stock'] && ($cashbox_d['from_stock']==$view_d['warehouses_id']) && ($cashbox_d['from_stock']!=$cashbox_d['in_stock']))): ?>
								<? $number++; ?>
								<div class="uc_ui uc_ui2" data-vid="<?=$view_d['id']?>" data-id="<?=$sel_d['id']?>" data-quantity="<?=$view_d['quantity']?>" data-qn="<?=$sel_d['quantity']?>">
									<div class="uc_uil">
										<div class="uc_ui_number"><?=$number?></div>
										<div class="uc_uiln">
											<div class="uc_ui_img lazy_img" data-src="https://lighterior.kz/assets/uploads/products/<?=$pitem_d['img']?>"><?=($pitem_d['img']!=null?'':'<i class="fal fa-user"></i>')?></div>
											<div class="uc_uinu">
												<div class="uc_ui_name"><?=$pitem_d['article']?> - <?=(product::pr_warehouses($view_d['warehouses_id']))['name']?></div>
												<div class="uc_ui_cont">
													<div><?=$product_d['name_ru']?></div>
													<? if ($pitem_d['color_id']): ?> <div><?=(product::pr_color($pitem_d['color_id']))['name_ru']?></div> <? endif ?>
													<? if ($pitem_d['size_id']): ?> <div><?=(product::pr_size($pitem_d['size_id']))['name']?></div> <? endif ?>
												</div>
											</div>
										</div>
										<div class="uc_uin_other disp_full">
											<st class="fr_number3"><?=$view_d['quantity']?> шт</st>
											<i class="fal fa-long-arrow-right"></i>
										</div>
										<div class="uc_uin_other">
											<input type="tel" class="uc_uin_calc_q fr_number3 cashbox_upd" value="<?=$sel_d['quantity']?>" data-lenght="1" />
										</div>
										<div class="uc_uin_other fr_number3">
											<?=$view_d['quantity'] - $sel_d['quantity']?> шт
										</div>
										<? if ($cashbox_d['in_stock']): ?>
											<div class="uc_uin_other">
												<?=product::in_stockq($sel_d['item_id'], $cashbox_d['in_stock']) + $sel_d['quantity']?> шт
											</div>
										<? endif ?>
									</div>
									<div class="uc_uin_cn cashbox_remove" data-id="<?=$sel_d['id']?>"><i class="fal fa-trash-alt"></i></div>
								</div>
							<? endif ?>
						<? endwhile ?>
					<? endif ?>

					<? if ($number == 0): ?> <div class="ds_nr"><i class="fal fa-ghost"></i><p>НЕТ</p></div> <? endif ?>
				</div>
			</div>

		</div>

	</div>

<? include "../block/footer.php"; ?>