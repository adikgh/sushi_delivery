<?php include "../../config/acore.php";

	// 
	if (!$user_id) header('location: /admin/');
	header('location: /admin/sales/retail/');


	// 
	$orders = db::query("select * from retail_orders where paid = 1 order by ins_dt desc limit 50");
	$filter = 0;


	// site setting
	$menu_name = 'retail';
	$site_set['header'] = true;
	$site_set['menu'] = true;
	$site_set['footer'] = false;
	$css = [];
	$js = [];
?>
<? include "../block/header.php"; ?>


<? include "../block/footer.php"; ?>