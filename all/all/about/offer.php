<?php include "../../config/core.php";

	// site setting
	$menu_name = 'offer';
	$site_set = [
      'header' => 'full',
		'footer' => 'false',
		'ublock' => 'true',
		'utop_nm' => 'Оферта',
	];
	$css = ['user', 'faq'];
	$js = ['user'];

?>
<?php include "../../block/header.php"; ?>
<?php include "../../about/faq/offer_t.php"; ?>
<?php include "../../block/footer.php"; ?>