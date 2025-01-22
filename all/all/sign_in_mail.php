<?php include "../config/core.php";

	// 
	if ($user_id) header('location: /u/c/');


	// site setting
	$menu_name = 'sign_in';
	$site_set = [
		'cl_wh' => '1',
		'utop_bk' => '../',
		'header' => 'full',
		'footer' => 'false',
	];
	$css = ['user'];
	$js = ['user'];
	
?>
<?php include "../block/header.php"; ?>


	<div class="u_sign">
		<div class="bl_c">
			<div class="usign_c">

				<div class="usign_img">
					<div class="lazy_img" data-src="/assets/img/icons/waving-hand_1f44b.png"></div>
				</div>

				<div class="usign_head">
					<h3 class="usign_h" data-pass="Қайта келуіңізбен">Қош келдіңіз</h3>
					<div class="usign_p"
						data-pass="Cіз тіркелгенсіз төменге құпия<br>сөзіңізді енгізеңіз"
						data-code="Сіз алғаш рет кіріп жатсыз,<br>тексеру мақсатында телефон<br>нөміріңізге код жібердім"
						data-reset-pass="Телефон нөміріңізге тексеру<br>кодын жібердім"
					>Аккаунтыңызға кіру үшін телефон<br>нөміріңізді немесе электронды<br>почтаңызды жазыңыз</div>
				</div>

				<div class="usign_cn">

					<div class="usign_f">
						<div class="usign_ex">
							<div class="usign_exi"><i class="fal fa-exclamation-circle"></i></div>
							<p>Автозаполнение-мен кірмеңіз, <br>нөміріңізді 8 ден бастайсыз (+7 емес)</p>
						</div>
						<div class="form_im form_im_ph">
							<i class="far fa-user form_icon"></i>
							<input type="text" class="form_im_txt login" placeholder="Нөмір немесе почта" data-lenght="6" data-sel="0" maxlength="50" />
						</div>
						<div class="form_im form_im_ps dsp_n">
							<i class="far fa-lock form_icon"></i>
							<input type="password" class="form_im_txt password" placeholder="Құпия сөз" data-lenght="6" data-sel="0" data-eye="0" />
							<i class="far fa-eye-slash form_icon_pass"></i>
						</div>
						<div class="form_im form_im_cd dsp_n">
							<i class="fal fa-lock-alt form_icon"></i>
							<input type="tel" class="form_im_txt code fr_code" placeholder="0000" data-lenght="4" data-sel="0" />
						</div>
					</div>

					<div class="si_blc_b ">
						<div class="form_im">
							<button class="btn btn_sign_in" data-type="login" data-pass="Кіру">
								<span>Жалғастыру</span>
								<i class="far fa-long-arrow-right"></i>
							</button>
						</div>
					</div>

					<div class="si_blc_bn">
						<div class="form_im cn_reset dsp_n">
							<div class="btn btn_back3 btn_pass_reset">Құпия сөзімді ұмыттым?</div>
						</div>
						<div class="form_im cn_reset_time dsp_n">
							<div class="btn btn_back3 btn_in_pass_reset" data-clc="Код қайта жіберу?">60</div>
						</div>
					</div>


				</div>

			</div>
		</div>
	</div>


<?php include "../block/footer.php"; ?>