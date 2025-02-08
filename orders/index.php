<? include "../config/core.php";

	// 
	if (!$user_id) header('location: /');
	if ($user_right['positions_id'] == 1 || $user_right['positions_id'] == 2 || $user_right['positions_id'] == 3) header('location: /orders/list.php');


   	$type = @$_GET['type'];
   	$sort = 'new'; 
	if (@$_GET['sort']) $sort = @$_GET['sort'];
	if (@$_GET['branch']) $branch = @$_GET['branch'];
	

	if (@$_GET['time']) {
		$time_sort = $_GET['time'];
		$start_cdate = date('Y-m-d 06:00:00', strtotime("$time_sort"));
		$end_cdate = date('Y-m-d 06:00:00', strtotime("$start_cdate +1 day"));
	}
	

	// $start_cdate = '2025-01-10';

	if ($sort == 'new') {
		$orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and `order_type` = 1 and `order_status` in(1, 2, 3) and `сourier_id` = '$user_id' and company_id = '$company' order by number asc");
	} else {
		if ($branch != 0) $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and `order_type` = 1 and `order_status` in(4, 6) and `сourier_id` = '$user_id' and company_id = '$company' and `branch_id` = '$branch' order by number desc");
		else $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and `order_type` = 1 and `order_status` in(4, 6) and `сourier_id` = '$user_id' and company_id = '$company' order by number desc");
	}



	$allorder['number'] = 0;
	$pay_delivery = 0;
	$allorder['pay_delivery'] = 0;
	$allorder['pay_qr'] = 0;
	$allorder['pay_cash'] = 0;


	// site setting
	$menu_name = 'new'; 
	if ($sort == 'history') $menu_name = 'history';
	$pod_menu_name = 'main';
	$css = ['orders'];
	$js = ['orders'];
?>
<? include "../block/header.php"; ?>

	<div class="flex_clm_rev">

		<div class="bl_c">

			<div class="uc_u">

				<? if ($orders != ''): ?>
					<? if (mysqli_num_rows($orders) != 0): ?>
						<? while ($buy_d = mysqli_fetch_assoc($orders)): ?>
							<? if ($buy_d['branch_id']) $branch_d = fun::branch($buy_d['branch_id']); ?>

							<div class="uc_ui">
								<div class="uc_uil2" >
									<div class="uc_uil2_top">
										<div class="uc_uil2_nmb"><?=$buy_d['number']?></div>
										<div class="uc_uil2_date">
											<div class="uc_uil2_date1"><?=@$branch_d['name']?></div>
											<div class=""><?=date("d-m-Y", strtotime($buy_d['ins_dt']))?> ⌛ <?=date("H:i", strtotime($buy_d['ins_dt']))?> <?=($buy_d['preorder_dt']?'| 🔴':'')?>  <?=($buy_d['preorder_dt']?$buy_d['preorder_dt']:'')?></div>
										</div>
										<? if ($buy_d['order_status'] == 1): ?>
											<div class="uc_uil2_chek">
												<div class="btn btn_cl btn_44 on_check" data-id="<?=$buy_d['id']?>"><i class="far fa-check"></i></div>
											</div>
										<? endif ?>
									</div>
									<div class="uc_uil2_raz">
										<div class="uc_uil2_trt">
											<div class="uc_uil2_trt1">Атауы</div>
											<div class="uc_uil2_trt2">Саны</div>
											<div class="uc_uil2_trt3">Бағасы</div>
										</div>
										<div class="uc_uil2_trc">

											<? 	
												$cashbox_id = $buy_d['id'];
												$cashboxp = db::query("select * from retail_orders_products where order_id = '$cashbox_id' order by ins_dt asc");
												$number = 0; $total = 0;
											?>
											<? if (mysqli_num_rows($cashboxp) != 0): ?>
												<? while ($sel_d = mysqli_fetch_assoc($cashboxp)): ?>
													<? 
														$number++; 
														$sum = $sel_d['quantity'] * $sel_d['price']; 
														$total = $total + $sum;
														$product_d = product::product($sel_d['product_id']);
													?>
													<div class="uc_uil2_trt">
														<div class="uc_uil2_trt1"><?=$number?>. <?=$product_d['name_ru']?></div>
														<div class="uc_uil2_trt2"><?=$sel_d['quantity']?> шт</div>
														<!-- <div class=""><?=$sel_d['price']?></div> -->
														<div class="uc_uil2_trt3 fr_price"><?=$sum?></div>
													</div>
												<? endwhile ?>
											<? endif ?>
											
											<div class="uc_uil2_trt">
												<div class="uc_uil2_trt1">Доставка</div>
												<div class="uc_uil2_trt3 fr_price"><?=$buy_d['pay_delivery']?></div>
											</div>
											<div class="uc_uil2_trt">
												<div class="uc_uil2_trt1">Предоплата</div>
												<div class="uc_uil2_trt2">-</div>
												<div class="uc_uil2_trt3 fr_price"><?=$buy_d['pay_qr']?></div>
											</div>
										</div>
										<div class="uc_uil2_trb">
											<div class="uc_uil2_trt1">К оплате</div>
											<div class="uc_uil2_trt2"></div>
											<div class="uc_uil2_trt3 fr_price"><?=$buy_d['pay_cash']?></div>
										</div>
									</div>
									<? if ($buy_d['address']): ?>
										<div class="uc_uil2_raz">
											<div class="uc_uil2_mi">
												<div class="uc_uil2_mi1">Адрес:</div>
												<div class="uc_uil2_mi2"><?=$buy_d['address']?></div>
											</div>
											<div class="uc_uil2_mib uc_uil2_mib1">
												<a class="btn btn_cl" href="https://2gis.ru/shymkent/search/<?=$buy_d['address']?>" target="_blank">Картадан ашу</a>
											</div>
										</div>
									<? endif ?>
									<? if ($buy_d['phone']): ?>
										<div class="uc_uil2_raz">
											<div class="uc_uil2_mi">
												<div class="uc_uil2_mi1">Номер:</div>
												<div class="uc_uil2_mi2 fr_phone"><?=$buy_d['phone']?></div>
											</div>
											<div class="uc_uil2_mib">
												<a class="btn btn_phone" href="tel:8<?=$buy_d['phone']?>">Званок</a>
												<a class="btn btn_whatsapp" href="https://wa.me/<?=$buy_d['phone']?>" target="_blank">Whatsapp</a>
											</div>
										</div>
									<? endif ?>

									<!-- <div class="uc_uin_other fr_price"><?=$buy_d['pay_qr']?> </div> -->
									<!-- <div class="uc_uin_other fr_price"><?=$buy_d['total'] - $buy_d['pay_qr']?></div> -->
								</div>
							</div>

							<? 
								$allorder['number'] = $allorder['number'] + 1;
								if ($buy_d['order_status'] != 5 && $buy_d['order_status'] != 6) {
									$pay_delivery = $buy_d['pay_delivery'] + 500;

									$allorder['pay_qr'] = $allorder['pay_qr'] + $buy_d['pay_qr'];
									$allorder['pay_delivery'] = $allorder['pay_delivery'] + $pay_delivery;
									$allorder['pay_cash'] = $allorder['pay_cash'] + ($buy_d['pay_cash'] - $pay_delivery);
								}
							?>

						<? endwhile ?>
					<? else: ?> <div class="ds_nr"><i class="fal fa-smoking"></i><p>демалыс</p></div> <? endif ?>
				<? else: ?> <div class="ds_nr"><i class="fal fa-smoking"></i><p>демалыс</p></div> <? endif ?>

			</div>

			<!-- Осы қатарды қосу қажет -->
			<!-- <div class="uc_ukb">
				<div class="btn btn_gr">Барлығы орындалды</div>
			</div> -->

		</div>


		<div class="hil_head">
			<div class="bl_c">

				<div class="hil_headc">
					<? if ($sort == 'history'): ?>
						<h4 class="hil_headc1 txt_c">Орындалған заказдар</h4>
					<? else: ?>
						<h4 class="hil_headc1 txt_c">Жеткізу қажет заказдар</h4>
					<? endif ?>
					<? if ($sort != 'new'): ?>
						<!-- <div class="hil_fr1">
							<div class="hil_fr1c on_sort_branch <?=($branch == 0?'hil_fr1c_act':'')?>" data-id="0">Барлығы</div>
							<div class="hil_fr1c on_sort_branch <?=($branch == 1?'hil_fr1c_act':'')?>" data-id="1">Банзай</div>
							<div class="hil_fr1c on_sort_branch <?=($branch == 2?'hil_fr1c_act':'')?>" data-id="2">Мастер</div>
						</div> -->

						<br>

						<div class="">
							<div class="form_im">
								<input class="form_dt on_sort_time" type="date" name="" id="" value="<?=date('Y-m-d', strtotime("$start_cdate"))?>">
							</div>
						</div>

					<? endif ?>
					<div class="hil_headc2">
						<div class="hil_headc2s">
							<span>Заказ саны:</span>
							<p><?=$allorder['number']?> шт</p>
						</div>
						<div class="hil_headc2s">
							<span>Доставкаға:</span>
							<p class="fr_price"><?=$allorder['pay_delivery']?></p>
						</div>
						<? if ($sort != 'new'): ?>
							<div class="hil_headc2s">
								<span>Предоплата:</span>
								<p class="fr_price"><?=$allorder['pay_qr']?></p>
							</div>
							<div class="hil_headc2s">
								<span>Кассаға:</span>
								<p class=""><?=$allorder['pay_cash']?> тг</p>
							</div>
						<? endif ?>

					</div>
				</div>

			</div>
		</div>

	</div>

<? include "../block/footer.php"; ?>