<?php include "../config/core.php";

	// 
	if ($user_id) {
		
	} else { header('location: /u/sign_in.php'); }
		

	// site setting
	$menu_name = 'dashboard';
	$site_set = [
		'header' => 'full',
		'footer' => 'false',
		'ublock' => 'true',
		'utop_nm' => 'Оқу үстелі',
		'utop_bk' => 'none'
	];
	$css = ['user','udashboard'];
	$js = ['user'];

?>
<?php include "../block/header.php"; ?>


	<div class="ud_top">
		<div class="bl_c">
			<div class="ud_top_n">
				<div class="ud_top_c">
					<div class="ud_top_ic">
						<?php if ($user['sex'] == 1): ?>
							<div class="lazy_img" data-src="/assets/img/icons/prince_light-skin-tone_1f934-1f3fb_1f3fb.png"></div>
						<?php else: ?>
							<div class="lazy_img" data-src="/assets/img/icons/princess_light-skin-tone_1f478-1f3fb_1f3fb.png"></div>
						<?php endif ?>
					</div>
					<div class="ud_top_in">
						<div class="ud_top_h">Сәлем, <?=$user['name']?> <div class="lazy_img" data-src="/assets/img/icons/waving-hand_1f44b.png"></div></div>
					</div>
				</div>
				<div class="ud_top_b">Қайта оралғаныңызға қуаныштымын! Бүгін сабағыңызды жалғастырыңыз. Күніңіз сәтті өтсін.</div>
			</div>
		</div>
	</div>

	<div class="ud2">
		<div class="bl_c">
			<div class="head_c">
				<h4>Бүгінгі курс</h4>
			</div>
			<div class="ud2_c">

			<?php $cours_sub = db::query("select * from cours_sub where user_id = '$user_id' order by ins_date desc"); ?>
			<?php if (mysqli_num_rows($cours_sub) != 0): ?>
				<?php while ($sub = mysqli_fetch_assoc($cours_sub)): ?>
					<?php $cours_d = fun::cours($sub['cours_id']); ?>
					<div class="ud2_i">
						<div class="ud2_il">
							<div class="ud2_ilt">
								<div class="ud2_ilta">
									<div class="lazy_img" data-src="/assets/img/cours/<?=$cours_d['img']?>"></div>
								</div>
								<svg class="progress_ring" width="74" height="74">
									<circle data-precent="100" class="progress_ring_c2" stroke-width="3" cx="37" cy="37" r="31" fill="transparent" />
									<circle data-precent="<?=$precent?>15" class="progress_ring_c" stroke-width="3" cx="37" cy="37" r="31" fill="transparent" />
								</svg>
							</div>
							<div class="ud2_ilb"><?=$precent?>15%</div>
						</div>
						<div class="ud2_ir">
							<div class="ud2_in"><?=$cours_d['name']?></div>
							<div class="ud2_ic">
								<div class="ud2_ici">
									<i class="fal fa-book-open"></i>
									<span><?=$cours_d['item']?> сабақ</span>
								</div>
								<div class="ud2_ici">
									<i class="fal fa-stopwatch"></i>
									<span><?=$cours_d['time_s']?></span>
								</div>
								<div class="ud2_ici">
									<i class="fal fa-clipboard-list-check"></i>
									<span><?=$cours_d['assig']?> тапсырма</span>
								</div>
								<div class="ud2_ici">
									<i class="fal fa-user-friends"></i>
									<span><?=$cours_d['view']?> студент</span>
								</div>
							</div>
							<a class="ud2_ib" href="/u/i/?id=<?=$cours_d['id']?>">
								<div class="btn btn_cl">Жалғастыру</div>
							</a>
						</div>
					</div>
				<?php endwhile ?>
			<?php endif ?>

			</div>
		</div>
	</div>

	<!-- <div class="">
		<div class="bl_c">
			Катигориялар
		</div>
	</div> -->

<?php include "../block/footer.php"; ?>