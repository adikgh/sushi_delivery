<? include "../config/core.php";


	// 
	// if (!$user_id) header('location: /');


	// site setting
	$menu_name = 'acc';
	$site_set = [
		'header' => 'user',
		'footer' => 'false',
      'ublock' => 'true',
		'utop_nm' => 'Жеке деректер',
		'utop_bk' => ' ',
	];
	$css = ['user', 'uacc'];
	$js = ['user'];
	
?>
<? include "../block/header.php"; ?>
<? include "acc_d.php"; ?>
<? include "../block/footer.php"; ?>