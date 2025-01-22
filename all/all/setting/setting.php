<?php include "../config/core.php";

	// 
	if (!$user_id) header('location: /u/sign_in.php');

	// site setting
	$menu_name = 'setting';
	$site_set = [
		'header' => 'false',
		'footer' => 'false',
		'ublock' => 'true',
	];

?>
<?php include "../block/header.php"; ?>

<?php include "../block/standart/dev2.php"; ?>

<?php include "../block/footer.php"; ?>