<?php include "../../config/core.php";

	// site setting
	$menu_name = 'faq';
	$site_set = [
      'header' => 'full',
		'footer' => 'false',
		'ublock' => 'true',
		'utop_nm' => 'Авторлық құқық',
	];
	$css = ['user', 'faq'];
	$js = ['user'];

?>
<?php include "../../block/header.php"; ?>
<?php include "../../about/faq/privacy_t.php"; ?>
<?php include "../../block/footer.php"; ?>