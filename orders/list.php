<? include "../config/core.php";

	// 
	if (!$user_id) header('location: /');



   	$type = @$_GET['type'];
   	$sort = 'new'; if (@$_GET['sort']) $sort = @$_GET['sort'];
	if (@$_GET['branch']) $branch = @$_GET['branch'];

	// $start_cdate = '2025-01-23';

	if ($sort == 'new') {
		$orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and `paid` = 1 and `order_type` = 1 and `order_status` in(1, 2, 3) and company_id = '$company' and `сourier_id` is null order by number asc");
	} elseif ($sort == 'myself') {
		$orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and `paid` = 1 and `order_type` = 2 and company_id = '$company' order by number desc");
	} else {
		if ($branch != 0) $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and `order_type` = 1 and company_id = '$company' and `branch_id` = '$branch' and `сourier_id` is not null order by number desc");
		else $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and `order_type` = 1 and company_id = '$company' and `сourier_id` is not null order by number desc");
	}



	$allorder['total'] = 0;
	$allorder['number'] = 0;
	$allorder['pay_qr'] = 0;
	$allorder['pay_delivery'] = 0;


	// site setting
	$menu_name = 'new'; 
	if ($sort == 'history') $menu_name = 'history';
	elseif ($sort == 'myself') $menu_name = 'myself';

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
							<? if ($buy_d['сourier_id']) $сourier_d = fun::user($buy_d['сourier_id']); ?>
							<? if ($buy_d['branch_id']) $branch_d = fun::branch($buy_d['branch_id']); ?>

							<div class="uc_ui">
								<div class="uc_uil2" >
									<div class="uc_uil2_top">
										<div class="uc_uil2_nmb"><?=$buy_d['number']?></div>
										<div class="uc_uil2_date">
											<div class="uc_uil2_date1"><?=@$branch_d['name']?></div>
											<div class=""><?=date("d-m-Y", strtotime($buy_d['ins_dt']))?> ⌛ <?=date("H:i", strtotime($buy_d['ins_dt']))?> <?=($buy_d['preorder_dt']?'| 🔴':'')?>  <?=($buy_d['preorder_dt']?$buy_d['preorder_dt']:'')?></div>
										</div>
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
											<div class="uc_uil2_trt3 fr_price"><?=$buy_d['total'] - $buy_d['pay_qr']?></div>
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

									<? if ($sort != 'myself'): ?>
										<div class="uc_uil2_raz">
											<div class="uc_uil2_mi">
												<div class="uc_uil2_mi1">Курьер:</div>
												<div class="uc_uil2_mi2"><?=($buy_d['сourier_id']?$сourier_d['name']:'Таңдалмаған')?></div>
											</div>
											<div class="uc_uil2_sel">
												<select name="" id="" class="on_staff" data-order-id="<?=$buy_d['id']?>" >
													<option value="" ><?=($buy_d['сourier_id']?'Ауыстыру':'Таңдау')?></option>
													<? if ($buy_d['сourier_id']): ?>
														<option value="" data-id="off">Тазалау</option>
													<? endif ?>
													<? $staff = db::query("select * from user_staff where positions_id = 6"); ?>
													<? while ($staff_d = mysqli_fetch_assoc($staff)): ?>
														<? $staff_user_d = fun::user($staff_d['user_id']); ?>
														<option value="" data-id="<?=$staff_d['user_id']?>" ><?=$staff_user_d['name']?></option>
													<? endwhile ?>
												</select>
											</div>
										</div>
									<? endif ?>


								</div>
							</div>

							<? 
								$allorder['number'] = $allorder['number'] + 1;
								if ($buy_d['order_status'] != 5 && $buy_d['order_status'] != 6) {
									$allorder['pay_delivery'] = $allorder['pay_delivery'] + $buy_d['pay_delivery'] + 500;
								}
							?>

						<? endwhile ?>
					<? else: ?> <div class="ds_nr"><i class="fal fa-ghost"></i><p>НЕТ</p></div> <? endif ?>
				<? else: ?> div class="ds_nr"><i class="fal fa-ghost"></i><p>НЕТ</p></div> <? endif ?>

			</div>

		</div>


		<div class="hil_head">
			<div class="bl_c">

				<div class="hil_headc">
					<? if ($sort == 'history'): ?>
						<h4 class="hil_headc1 txt_c">Белгіленген заказдар</h4>
					<? elseif ($sort == 'myself'): ?>
						<h4 class="hil_headc1 txt_c">Собой</h4>
					<? else: ?>
						<h4 class="hil_headc1 txt_c">Жаңа заказдар</h4>
					<? endif ?>
					<? if ($sort == 'history'): ?>
						<!-- <div class="hil_fr1">
							<div class="hil_fr1c on_sort_branch <?=($branch == 0?'hil_fr1c_act':'')?>" data-id="0">Барлығы</div>
							<div class="hil_fr1c on_sort_branch <?=($branch == 1?'hil_fr1c_act':'')?>" data-id="1">Банзай</div>
							<div class="hil_fr1c on_sort_branch <?=($branch == 2?'hil_fr1c_act':'')?>" data-id="2">Мастер</div>
						</div> -->
					<? endif ?>
					<div class="hil_headc2">
						<div class="hil_headc2s">
							<span>Заказ саны:</span>
							<p><?=$allorder['number']?> шт</p>
						</div>
						<!-- <div class="hil_headc2s">
							<span>Ақшасы:</span>
							<p class="fr_price"><?=$allorder['pay_delivery']?></p>
						</div> -->
					</div>
				</div>

			</div>
		</div>

	</div>

<? include "../block/footer.php"; ?>