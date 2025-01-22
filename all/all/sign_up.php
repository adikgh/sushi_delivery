<?php include "../config/core.php";

	//
	if ($user_id) header('location: /user/cours/');

	// cours
	if ($user_id && isset($_GET['cl'])) header('location: /user/cours/item/?id='.$_GET['cl']);
	if ($user_id && isset($_GET['sub'])) header('location: /user/sub/');

	// site setting
	$menu_name = 'sign_up';
	$site_set = [
		'cl_wh' => '1',
		'footer' => 'false',
		'menu' => 2,
	];
	$css = ['user'];
	$js = ['user'];
	
?>
<?php include "../block/header.php"; ?>


	<div class="u_sign">
		<div class="bl_c">
			<div class="usign_c">

				<div class="usign_img">
					<div class="lazy_img" data-src="/assets/img/icons/party-popper_1f389.png"></div>
				</div>

				<div class="usign_head">
					<h3 class="usign_h">Тіркелу</h3>
					<div class="usign_p">Бұл ұзақ уақыт алмайды, төмендегі <br>форманы толтырыңыз</div>
				</div>

				<div class="usign_cn">

					<div class="usign_f">
						<div class="form_im form_im_ph">
							<i class="far fa-mobile form_icon"></i>
							<input type="tel" class="form_im_txt fr_phone phone" placeholder="8 (700) 000-00-00" data-lenght="11" data-sel="0" />
						</div>
						<div class="form_im form_im_cd dsp_n">
							<i class="far fa-lock-alt form_icon"></i>
							<input type="tel" class="form_im_txt code fr_code" placeholder="0000" data-lenght="4" data-sel="0" />
						</div>
						<div class="form_im form_im_nm dsp_n">
							<i class="far fa-user form_icon"></i>
							<input type="text" class="form_im_txt name" placeholder="Есіміңіз .." data-lenght="2" data-sel="0" />
						</div>
						<div class="form_im form_im_ps dsp_n">
							<i class="far fa-lock form_icon"></i>
							<input type="password" class="form_im_txt password" placeholder="Құпия сөз ойлап табыңыз" data-lenght="6" data-sel="0" />
							<i class="far fa-eye-slash form_icon_pass"></i>
						</div>
					</div>

					<div class="si_blc_b">
						<div class="form_im si_blc_b">
							<button class="btn btn_sign_up" data-type="phone" data-final="Тіркелемін">Тексеру</button>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>


<?php include "../block/footer.php"; ?>


