<? include "../config/core.php";

	// 
	if (!$user_id) header('location: /');



   	$type = @$_GET['type'];
   	$sort = 1; if (@$_GET['sort']) $sort = @$_GET['sort'];


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



	// if (@$_GET['status'] && @$_GET['staff']) {
	// 	$status = $_GET['status'];
	// 	$staff = $_GET['staff'];
	// 	if ($staff == 'off') $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and order_status = '$status' and сourier_id is null  and branch_id = '$branch' order by number desc");
	// 	else $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and order_status = '$status' and сourier_id  = '$staff'  and branch_id = '$branch' order by number desc");
	// } elseif (@$_GET['status']) {
	// 	$status = $_GET['status'];
	// 	$orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and order_status = '$status'  and branch_id = '$branch' order by number desc");
	// } elseif (@$_GET['staff']) {
	// 	$staff = $_GET['staff'];
	// 	if ($staff == 'off') $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and сourier_id is null  and branch_id = '$branch' order by number desc");
	// 	else $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and сourier_id  = '$staff'  and branch_id = '$branch' order by number desc");
	// } else 
	

	$start_cdate = '2025-01-15';

	$orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and branch_id = '$branch' and `order_status` = 1 order by number asc");


	$allorder['total'] = 0;
	$allorder['pay_qr'] = 0;
	$allorder['pay_delivery'] = 0;


	// site setting
	$menu_name = 'new'; if ($sort == 'history') $menu_name = 'history';
	$pod_menu_name = 'main';
	$css = ['orders'];
	$js = ['orders'];
?>
<? include "../block/header.php"; ?>

	<div class="">
		<div class="bl_c">

			<div class="uc_u">

				<? if ($orders != ''): ?>
					<? if (mysqli_num_rows($orders) != 0): ?>
						<? while ($buy_d = mysqli_fetch_assoc($orders)): ?>

							<div class="uc_ui">
								<div class="uc_uil2" >
									<div class="">
										<div class="uc_uil2_nmb"><?=$buy_d['number']?></div>
										<div class=""><?=$buy_d['name']?></div>
									</div>
									<div class="uc_uil2_date">
										<div class=""><?=date("Y-m-d", strtotime($buy_d['ins_dt']))?></div>
										<div class=""><?=date("H:i", strtotime($buy_d['ins_dt']))?></div>
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
										</div>
										<div class="uc_uil2_trb">
											<div class="uc_uil2_trt1">Жалпы</div>
											<div class="uc_uil2_trt2"></div>
											<div class="uc_uil2_trt3 fr_price"><?=$buy_d['total']?></div>
										</div>
									</div>
									<div class="uc_uil2_raz">
										<div class="uc_uil2_mi">
											<div class="uc_uil2_mi1">Адрес:</div>
											<div class="uc_uil2_mi2"><?=$buy_d['address']?></div>
										</div>
										<div class="uc_uil2_mib uc_uil2_mib1">
											<div class="btn btn_cl">Картадан ашу</div>
										</div>
									</div>
									<div class="uc_uil2_raz">
										<div class="uc_uil2_mi">
											<div class="uc_uil2_mi1">Номер:</div>
											<div class="uc_uil2_mi2"><?=$buy_d['phone']?></div>
										</div>
										<div class="uc_uil2_mib">
											<a class="btn btn_phone">Званок</a>
											<a class="btn btn_whatsapp">Whatsapp</a>
										</div>
									</div>

									<!-- <div class="uc_uin_other fr_price"><?=$buy_d['pay_qr']?> </div> -->
									<!-- <div class="uc_uin_other fr_price"><?=$buy_d['total'] - $buy_d['pay_qr']?></div> -->
								</div>
							</div>

							<? 
								// $allorder['total'] = $allorder['total'] + $buy_d['total'];
								// $allorder['pay_qr'] = $allorder['pay_qr'] + $buy_d['pay_qr'];
								// $allorder['pay_delivery'] = $allorder['pay_delivery'] + $buy_d['pay_delivery'] + 500;
							?>

						<? endwhile ?>
					<? else: ?> <div class="ds_nr"><i class="fal fa-ghost"></i><p>НЕТ</p></div> <? endif ?>
				<? else: ?> div class="ds_nr"><i class="fal fa-ghost"></i><p>НЕТ</p></div> <? endif ?>

			</div>

		</div>
	</div>

<? include "../block/footer.php"; ?>