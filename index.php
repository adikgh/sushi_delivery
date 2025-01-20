<? include "config/core.php";

   // 
   if ($user_id) header('location: /orders/');


	// site setting
	$menu_name = 'sign';
	$site_set['header'] = false;
	$site_set['menu'] = false;
	$site_set['footer'] = false;
	$css = ['main'];
	$js = ['main'];
?>
<? include "block/header.php"; ?>

	<div class="u_sign">
		<div class="bl_c">
			<div class="usign_c">

				<div class="usign_head"><h3 class="usign_h">Доставка</h3></div>
				<div class="usign_cn">
					<div class="form_im form_im_ph">
						<i class="far fa-mobile form_icon"></i>
						<input type="tel" class="form_txt fr_phone phone" placeholder="8 (700) 000-00-00" data-lenght="11" data-sel="0" />
					</div>
					<div class="form_im form_im_ps">
						<i class="far fa-lock form_icon"></i>
						<input type="password" class="form_txt password" placeholder="Пароль" data-lenght="6" data-sel="0" data-eye="0" />
						<i class="far fa-eye-slash form_icon_pass"></i>
					</div>
					<div class="form_im">
						<button class="btn btn_sign"><span>Вход</span><i class="far fa-long-arrow-right"></i></button>
					</div>
					<div class="form_im si_blc_bn">
						<div class="btn btn_back3 txt_c" href="sign_reset.php">Забыл пароль?</div>
					</div>
				</div>

			</div>
		</div>
	</div>

<? include "block/footer.php"; ?>