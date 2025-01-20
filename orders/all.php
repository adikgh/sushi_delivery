<? include "../config/core.php";

	// 
	if (!$user_id) header('location: /');



   	$type = @$_GET['type'];


	// if (@$_GET['status']) {
	// 	$status = $_GET['status'];
	// 	$orders_all = db::query("select * from retail_orders where ins_dt LIKE '%$currentdate%' and order_status = '$status' ");
	// } else $orders_all = db::query("select * from retail_orders where ins_dt LIKE '%$currentdate%' ");
	// $page_result = mysqli_num_rows($orders_all);
	// $orders = '';

	

	// filter user all
	// if ($type != 'return') {
	// 	if ($_GET['on'] == 1) $orders_all = db::query("select * from retail_orders where paid = 1 ");
	// 	elseif ($_GET['off'] == 1) $orders_all = db::query("select * from retail_orders where paid = 1 ");
	// 	else 

	// } else {
	// 	if ($_GET['on'] == 1) $orders_all = db::query("select * from retail_returns where returns = 1 ");
	// 	elseif ($_GET['off'] == 1) $orders_all = db::query("select * from retail_returns where returns = 1 ");
	// 	else $orders_all = db::query("select * from retail_returns where returns = 1 ");
	// 	$page_result = mysqli_num_rows($orders_all);
	// }

	// $orders_all = db::query("select * from retail_orders where ins_dt LIKE '%$currentdate%' ");
	// $page_result = mysqli_num_rows($orders_all);
	// $orders = '';

	// if ($page_result) {
		// page number
		// $page = 1; if (@$_GET['page'] && is_int(intval(@$_GET['page']))) $page = @$_GET['page'];
		// $page_age = 250;
		// $page_all = ceil($page_result / $page_age);
		// if ($page > $page_all) $page = $page_all;
		// $page_start = ($page - 1) * $page_age;
		// $number = $page_start;

		// filter cours
		// if ($type != 'return') {
		// 	if ($_GET['on'] == 1) $orders = db::query("select * from retail_orders where paid = 1  order by ins_dt desc limit $page_start, $page_age");
		// 	elseif ($_GET['off'] == 1) $orders = db::query("select * from retail_orders where paid = 1  order by ins_dt desc limit $page_start, $page_age");
		// 	else 
		// } else {
		// 	if ($_GET['on'] == 1) $orders = db::query("select * from retail_returns where returns = 1  order by ins_dt desc limit $page_start, $page_age");
		// 	elseif ($_GET['off'] == 1) $orders = db::query("select * from retail_returns where returns = 1  order by ins_dt desc limit $page_start, $page_age");
		// 	else $orders = db::query("select * from retail_returns where returns = 1  order by ins_dt desc limit $page_start, $page_age");
		// }

		// }



	if (@$_GET['status'] && @$_GET['staff']) {
		$status = $_GET['status'];
		$staff = $_GET['staff'];
		if ($staff == 'off') $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and order_status = '$status' and сourier_id is null  and branch_id = '$branch' order by number desc");
		else $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and order_status = '$status' and сourier_id  = '$staff'  and branch_id = '$branch' order by number desc");
	} elseif (@$_GET['status']) {
		$status = $_GET['status'];
		$orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and order_status = '$status'  and branch_id = '$branch' order by number desc");
	} elseif (@$_GET['staff']) {
		$staff = $_GET['staff'];
		if ($staff == 'off') $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and сourier_id is null  and branch_id = '$branch' order by number desc");
		else $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and сourier_id  = '$staff'  and branch_id = '$branch' order by number desc");
	} else $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate'  and branch_id = '$branch' order by number desc");


	$allorder['total'] = 0;
	$allorder['pay_qr'] = 0;
	$allorder['pay_delivery'] = 0;


	// site setting
	$menu_name = 'orders';
	$pod_menu_name = 'main';
	$css = ['orders'];
	$js = ['orders'];
?>
<? include "../block/header.php"; ?>

	<div class="">
		<div class="bl_c">

			<div class="">
				<div class="btn_sel btn_sel2">
					<div class="btn cashbox_pay">Новый заказ</div>
					<!-- <a class="<?=($type!='return'?'btn_sel_act':'')?>" href="?type=main" >Продажи</a> -->
					<!-- <a class="<?=($type=='return'?'btn_sel_act':'')?>" href="?type=return">Возврат</a> -->
				</div>
			</div>

			<br>

			<div class="uc_u new_all_up">

				<div class="uc_uc">

					<? if ($orders != ''): ?>
					<? if (mysqli_num_rows($orders) != 0): ?>
						<? while ($buy_d = mysqli_fetch_assoc($orders)): ?>

							<div class="uc_ui">
								<div class="uc_uil2" href="list.php?id=<?=$buy_d['id'].($type=='return'?'&type=return':'')?>">
									<div class="uc_ui_number"><?=$buy_d['number']?></div>
									<div class="uc_uin_other">
										<select name="" id="" class="on_status" data-order-id="<?=$buy_d['id']?>" >
											<? $orders_status = db::query("select * from retail_orders_status"); ?>
											<? while ($orders_status_d = mysqli_fetch_assoc($orders_status)): ?>
												<option data-id="<?=$orders_status_d['id']?>" <?=($buy_d['order_status'] == $orders_status_d['id']?'selected':'')?> value="" ><?=$orders_status_d['name']?></option>
											<? endwhile ?>
										</select>
									</div>
									<div class="uc_uin_other">
										<select name="" id="" class="on_staff" data-order-id="<?=$buy_d['id']?>" >
											<option value="" >Не выбрано</option>
											<? $staff = db::query("select * from user_staff where positions_id = 6"); ?>
											<? while ($staff_d = mysqli_fetch_assoc($staff)): ?>
												<? $staff_user_d = fun::user($staff_d['user_id']); ?>
												<option value="" data-id="<?=$staff_d['user_id']?>" <?=($buy_d['сourier_id'] == $staff_d['user_id']?'selected':'')?>><?=$staff_user_d['name']?></option>
											<? endwhile ?>
										</select>
									</div>
									<div class="uc_uin_other fr_price"><?=$buy_d['total']?></div>
									<div class="uc_uin_other fr_price"><?=$buy_d['pay_qr']?> </div>
									<div class="uc_uin_other fr_price"><?=$buy_d['total'] - $buy_d['pay_qr']?></div>
									<div class="uc_uin_other fr_price"><?=($buy_d['pay_delivery']?$buy_d['pay_delivery'] + 500:0)?></div>
									<div class="uc_uin_other fr_price"><?=($buy_d['pay_delivery']?$buy_d['total'] - $buy_d['pay_delivery'] - 500:$buy_d['total'] - $buy_d['pay_delivery'])?></div>
									<div class="uc_uib">
										<div class="uc_uibo on_delete" data-id="<?=$buy_d['id']?>"><i class="fal fa-trash-alt"></i></div>
									</div>
								</div>

							</div>

							<? 
								$allorder['total'] = $allorder['total'] + $buy_d['total'];
								$allorder['pay_qr'] = $allorder['pay_qr'] + $buy_d['pay_qr'];
								$allorder['pay_delivery'] = $allorder['pay_delivery'] + $buy_d['pay_delivery'] + 500;
							?>

						<? endwhile ?>
					<? else: ?> <div class="ds_nr"><i class="fal fa-ghost"></i><p>НЕТ</p></div> <? endif ?>
					<? else: ?> div class="ds_nr"><i class="fal fa-ghost"></i><p>НЕТ</p></div> <? endif ?>

				</div>
				
				<div class="uc_uc">
					<div class="uc_ui " style="background-color: #f5f5f5;">
						<div class="uc_uil2">
							<div class="uc_ui_number">0</div>
							<div class="uc_uin_other">
								<select name="status" class="on_sort_status" data-order-id="<?=$buy_d['id']?>" >
									<option data-id="" value="">Барлығы</option>
									<? $orders_status = db::query("select * from retail_orders_status"); ?>
									<? while ($orders_status_d = mysqli_fetch_assoc($orders_status)): ?>
										<option data-id="<?=$orders_status_d['id']?>" <?=(@$_GET['status'] == $orders_status_d['id']?'selected':'')?> value="" ><?=$orders_status_d['name']?></option>
									<? endwhile ?>
								</select>
							</div>
							<div class="uc_uin_other">
								<select name="staff" class="on_sort_staff" data-order-id="<?=$buy_d['id']?>" >
									<option data-id="" value="">Барлығы</option>
									<option data-id="off" <?=(@$_GET['staff'] == 'off'?'selected':'')?> value="">Таңдалмаған</option>
									<? $staff = db::query("select * from user_staff where positions_id = 6"); ?>
									<? while ($staff_d = mysqli_fetch_assoc($staff)): ?>
										<? $staff_user_d = fun::user($staff_d['user_id']); ?>
										<option data-id="<?=$staff_d['user_id']?>" <?=(@$_GET['staff'] == $staff_d['user_id']?'selected':'')?> value=""><?=$staff_user_d['name']?></option>
									<? endwhile ?>
								</select>
							</div>
							<div class="uc_uin_other fr_price"><?=$allorder['total']?></div>
							<div class="uc_uin_other fr_price"><?=$allorder['pay_qr']?> </div>
							<div class="uc_uin_other fr_price"><?=$allorder['total'] - $allorder['pay_qr']?></div>
							<div class="uc_uin_other fr_price"><?=$allorder['pay_delivery']?></div>
							<div class="uc_uin_other fr_price"><?=$allorder['total'] - $allorder['pay_delivery']?></div>
							<div class="uc_uib"></div>
						</div>
					</div>
				</div>

				<div class="uc_uh">
					<div class="uc_uh2">
						<div class="uc_uh_number">#</div>
						<div class="uc_uh_other">Статус</div>
						<div class="uc_uh_other">Курьер</div>
						<div class="uc_uh_other">Общий сумма</div>
						<div class="uc_uh_other">Предоплата (QR)</div>
						<div class="uc_uh_other">Қалғаны</div>
						<div class="uc_uh_other">ЗП Курьер (Доставка)</div>
						<div class="uc_uh_other">Остаток</div>
						<div class="uc_uh_cn"></div>
					</div>
				</div>

				<!-- <div class="uc_us">
					<div class="form_im uc_usn">
						<input type="text" placeholder="Поиск" class="order_search_in">
						<i class="fal fa-search form_icon"></i>
					</div>
				</div> -->

			</div>

		</div>
	</div>

<? include "../block/footer.php"; ?>


	<!--  -->
	<div class="pop_bl pop_bl2 cashbox_pay_block">
		<div class="pop_bl_a cashbox_pay_back"></div>
		<div class="pop_bl_c">
			<div class="head_c">
				<h4>Оплата</h4>
				<div class="btn btn_dd cashbox_pay_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl">
				<div class="form_c">

					<div class="">
						<div class="form_im">
							<div class="form_span">Номер заказа:</div>
							<input type="tel" class="form_txt fr_number2 order_number_sel" placeholder="0" value="" data-val="">
							<i class="fal fa-solar-panel form_icon"></i>
						</div>
						<div class="form_im ">
							<div class="form_span">Общий цена:</div>
							<input type="tel" class="form_txt fr_price btype_totol" placeholder="0" data-val="0">
							<i class="fal fa-tenge form_icon"></i>
						</div>
						<div class="form_im ">
							<div class="form_span">Доставка:</div>
							<input type="tel" class="form_txt fr_price btype_delivery" placeholder="0" data-val="0">
							<i class="fal fa-tenge form_icon"></i>
						</div>
						<div class="form_im ">
							<div class="form_span">Предоплата:</div>
							<input type="tel" class="form_txt fr_price btype_qr" placeholder="0" value="" data-val="">
							<i class="fal fa-tenge form_icon"></i>
						</div>
					</div>

					<div class="form_im">
						<div class="btn cashbox_pay2" data-branch="<?=$branch?>">Сақтау</div>
					</div>

				</div>

			</div>
		</div>
	</div>