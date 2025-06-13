<? include "config/core.php";

	if ($user['password'] != '123456') header('location: /orders/');

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

				<div class="usign_head"><h3 class="usign_h">Жаңа пароль орнату керек</h3></div>
				<div class="usign_cn">
					<div class="form_im form_im_ps">
						<i class="far fa-lock form_icon"></i>
						<input type="password" name="pass_new" class="form_txt password password_new1" placeholder="Пароль" data-lenght="6" data-sel="0" data-eye="0" />
						<i class="far fa-eye-slash form_icon_pass"></i>
					</div>
					<div class="form_im form_im_ps">
						<i class="far fa-lock form_icon"></i>
						<input type="password" name="pass_new2" class="form_txt password password_new2" placeholder="Парольді қайтала" data-lenght="6" data-sel="0" data-eye="0" />
						<i class="far fa-eye-slash form_icon_pass"></i>
					</div>
					<div class="form_im">
						<button class="btn btn_pass_ubd">Сақтау</button>
					</div>
				</div>

			</div>
		</div>
	</div>

<? include "block/footer.php"; ?>