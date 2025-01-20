<?php include "../config/core.php";

	// 
	if (!$user_id) header('location: /');


	// 
	$cashbox = db::query("select * from retail_returns where user_id = '$user_id' and returns = 0 order by id desc limit 1");
	if (mysqli_num_rows($cashbox)) {
		$cashbox_d = mysqli_fetch_assoc($cashbox);
		$cashbox_id = $cashbox_d['id'];
	} else {
		$cashbox_id = (mysqli_fetch_assoc(db::query("SELECT * FROM `retail_returns` order by id desc")))['id'] + 1;
		$ins = db::query("INSERT INTO `retail_returns`(`id`, `user_id`) VALUES ('$cashbox_id', '$user_id')");
	}
	$cashboxp = db::query("select * from retail_returns_products where return_id = '$cashbox_id' order by ins_dt desc");
	$number = 0; $total = 0;


	// site setting
	$menu_name = 'return';
	$site_set['swiper'] = true;
	$css = ['cashbox'];
	$js = ['return'];
?>
<?php include "../block/header.php"; ?>

	<div class="cash_bl1">

		<div class="cash_bl1_l">
			<div class="bl_c">
				<div class="uc_us">
					<div class="form_im uc_usn">
						<input type="text" class="form_txt sub_user_search_in cashbox_search" data-oid="<?=$cashbox_id?>" placeholder="Поиск" autofocus>
						<i class="fal fa-search form_icon"></i>
					</div>
					<div class="uc_usb">
						<div class="btn btn_cm">Каталог</div>
						<div class="btn_sel">
							<a class="<?=($view_pr?'btn_sel_act':'')?>" href="?view_pr=list" ><i class="far fa-list-ol"></i></a>
							<a class="<?=($view_pr?'':'btn_sel_act')?>" href="?view_pr=0"><i class="far fa-th-list"></i></a>
						</div>
					</div>
					<div class="uc_use">
						<div class="btn btn_dd_cm"><i class="fal fa-bars"></i></div>
					</div>
				</div>
			</div>
			<div class="cash_bl1_la"></div>
			<div class="cash_bl1_lsr">
				<div class="uc_u">
					<div class="uc_uc lazy_c"></div>
				</div>
			</div>
			<div class="uc_uh">
				<div class="uc_uh2">
					<div class="uc_uh_number">#</div>
					<div class="uc_uh_name">Наименование</div>
					<div class="uc_uh_other">Цена</div>
					<div class="uc_uh_other">Количество</div>
					<div class="uc_uh_other">Сумма</div>
				</div>
				<div class="uc_uh_cn"></div>
			</div>
		</div>


		<div class="cash_bl1_r">

			<div class="cash_bl1_rc">
				<div class="uc_u <?=($view_pr?'uc_u2':'')?>">
					<div class="uc_uc lazy_c">
						<? if (mysqli_num_rows($cashboxp)): ?>
							<? while ($sel_d = mysqli_fetch_assoc($cashboxp)): ?>
								<? $number++; $sum = $sel_d['quantity'] * $sel_d['price']; $total = $total + $sum; ?>
								<? $product_d = product::product($sel_d['product_id']); ?>
								<? $pitem_d = product::pr_item($sel_d['product_item_id']); ?>
								<div class="uc_ui uc_ui2" data-id="<?=$sel_d['id']?>" data-item-id="<?=$pitem_d['id']?>" data-pr="<?=$sel_d['price']?>" data-qn="<?=$sel_d['quantity']?>" data-sum="<?=$sum?>">
									<div class="uc_uil">
										<div class="uc_ui_number"><?=$number?></div>
										<div class="uc_uiln">
											<div class="uc_ui_img lazy_img" data-src="https://lighterior.kz/assets/uploads/products/<?=$pitem_d['img']?>">
												<?=($pitem_d['img']!=null?'':'<i class="fal fa-box"></i>')?>
											</div>
											<div class="uc_uinu">
												<div class="uc_ui_name"><?=$product_d['name_ru']?></div>
												<? if ($pitem_d['color_id'] || $pitem_d['size_id']): ?>
													<div class="uc_ui_cont">
														<? if ($pitem_d['color_id']): ?> <div><?=(product::pr_color($pitem_d['color_id']))['name_ru']?></div> <? endif ?>
														<? if ($pitem_d['size_id']): ?> <div><?=(product::pr_size($pitem_d['size_id']))['name']?></div> <? endif ?>
													</div>
												<? endif ?>
											</div>
										</div>
										<div class="uc_uin_other">
											<input type="tel" class="uc_uin_calc_q fr_price cashbox_pr" value="<?=$sel_d['price']?>" data-lenght="1" />
										</div>
										<div class="uc_uin_other" data-max="<?=$quantity?>">
											<input type="tel" class="uc_uin_calc_q fr_number3 cashbox_qn" value="<?=$sel_d['quantity']?>" data-lenght="1" />
										</div>
										<div class="uc_uin_other cashbox_sum fr_price"><?=$sum?></div>
									</div>
									<div class="uc_uin_cn cashbox_remove" data-id="<?=$sel_d['id']?>"><i class="fal fa-trash-alt"></i></div>
								</div>
							<? endwhile ?>
						<? else: ?>
							<div class="ds_nr"><p>Пустой список</p></div>
						<? endif ?>
					</div>
				</div>
			</div>

		</div>

		<div class="cash_bl1_rb <?=(!mysqli_num_rows($cashboxp)?'dsp_n':'')?>">
			<div class="cash_bl1_rbl">
				<div class="cash_bl1_rblin">Итого:</div>
				<div class="cash_bl1_rblip fr_price"><?=$total?></div>
			</div>
			<div class="cash_bl1_rbr">
				<div class="btn cashbox_pay" data-id="<?=$cashbox_id?>">Возврат</div>
			</div>
		</div>

	</div>

<?php include "../block/footer.php"; ?>