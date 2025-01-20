<? include "../config/core.php";

	// 
	if (!$user_id) header('location: /');


	// site setting
	$menu_name = 'acc';
	// $css = [''];
	// $js = [''];
?>
<? include "../block/header.php"; ?>

	<div class="bl_c">
		<div class="onj">
			<a class="btn btn_cl" href="/exit.php">Шығу</a>
		</div>
	</div>


<? include "../block/footer.php"; ?>