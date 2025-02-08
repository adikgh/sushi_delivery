<? include "../config/core.php";

	// Қолданушыны тексеру
	if (!$user_id) header('location: /');

	// Сайттың баптаулары
	$menu_name = 'acc';
	$site_set['utop_nm'] = 'Жеке деректер';
	$css = ['acc'];
	$js = ['admin'];
?>
<? include "../block/header.php"; ?>

	<div class="up">

		<div class="up_top">
			<div class="up_lg">
				<div class="up_logo">
					<? if ($user['img']): ?> <div class="up_logo_c lazy_img" data-src="/assets/uploads/users/<?=$user['img']?>"></div>
					<? else: ?> <div class="up_logo_icons lazy_img" data-src="/assets/img/icons/princess_light-skin-tone_1f478-1f3fb_1f3fb.png"></div> <? endif ?>
				</div>
				<div class="up_logo_upd"><i class="fal fa-camera"></i></div>
			</div>
			<div class="up_inf">
				<div class="up_name"><?=$user['name']?> <?=$user['surname']?></div>
				<div class="up_phone fr_phone"><?=$user['phone']?></div>
			</div>
		</div>

		<div class="bl_c">
			
			<div class="up_c">

				<div class="up_lt">
					<div class="up_li">
						<div class="menu_cin"><i class="fal fa-user-circle"></i></div>
						<div class="menu_cih">Жеке деректер</div>
					</div>

					<? if ($super == 3 || $user_right['positions_id'] == 2 || $user_right['positions_id'] == 1): ?>
						<a class="up_li" href="/users/">
							<div class="menu_cin"><i class="fal fa-users"></i></div>
							<div class="menu_cih">Курьерлер</div>
						</a>
					<? else: ?>
						<!-- <a class="up_li" href="/users/">
							<div class="menu_cin"><i class="fal fa-history"></i></div>
							<div class="menu_cih">Тарих</div>
						</a> -->
					<? endif ?>
					<? if ($user_right['super_v'] == 1): ?>
						<? if ($super == 6): ?>
							<div class="up_li on_superv6" data-id="<?=$user_right['id']?>" href="/users/">
								<div class="menu_cin"><i class="fal fa-plus"></i></div>
								<div class="menu_cih">Админ болу</div>
							</div>
						<? else: ?>
							<div class="up_li on_superv3" data-id="<?=$user_right['id']?>" href="/users/">
								<div class="menu_cin"><i class="fal fa-plus"></i></div>
								<div class="menu_cih">Курьер болу</div>
							</div>
						<? endif ?>
					<? endif ?>

				</div>

				<!-- <div class="up_lt">
					<a class="up_li" href="#">
						<div class="menu_cin"><i class="fal fa-question-circle"></i></div>
						<div class="menu_cih">Жиі қойылатын сұрақтар</div>
					</a>
					<a class="up_li" href="https://wa.me/<?=$site['whatsapp']?>">
						<div class="menu_cin"><i class="fal fa-comment-dots"></i></div>
						<div class="menu_cih">Көмек (Whatsapp)</div>
					</a>
				</div> -->
				
				<!-- <div class="up_lt">
					<a class="up_li" href="#">
						<div class="menu_cin"><i class="fal fa-award"></i></div>
						<div class="menu_cih">Академия жайлы</div>
					</a>
					<a class="up_li" href="/education/all/offer.php">
						<div class="menu_cin"><i class="fal fa-users-cog"></i></div>
						<div class="menu_cih">Қолдану ережелері</div>
					</a>
					<a class="up_li" href="/education/all/privacy.php">
						<div class="menu_cin"><i class="fal fa-users-cog"></i></div>
						<div class="menu_cih">Авторлық құқық</div>
					</a>
				</div> -->

				<div class="up_exit">
					<a class="btn btn_back2" href="/exit.php">
						<i class="far fa-sign-out"></i>
						<span>Шығу</span>
					</a>
				</div>

			</div>
			<div class="up_cg">
				<a href="https://gprog.kz" target="_blank" class="gprog_bl">
					<span>#gprog-та</span>
					<div class="gprog_heart"><i class="fas fa-heart"></i></div>
					<span>жасалған</span>
				</a>
			</div>

		</div>
	</div>

<? include "../block/footer.php"; ?>