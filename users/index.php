<? include "../config/core.php";
	
	// Қолданушыны тексеру
	if (!$user_id) header('location: /');


	$number = '';


	// Сайттың баптаулары
	$menu_name = 'users';
	$site_set['utop_nm'] = 'э';
	$css = ['item', 'user2'];
	$js = ['admin'];

?>
<? include "../block/header.php"; ?>

	<div class="uitem">
		<div class="bl_c">

			<div class="ucours_t">
				<div class="ucours_tl">
					<div class="ucours_tm ucours_tm_btn">
						<button class="btn btn_cm add_user_btn">
							<i class="far fa-user-plus"></i>
							<span>Қосу</span>
						</button>
					</div>
				</div>
			</div>
			
			<!-- list -->
			<div class="uc_u">
				
				<div class="form_im uc_us">
					<input type="text" placeholder="Іздеуді қолданыңыз" class="form_im_txt cours_user_search_in" data-cours-id="<?=$cours_id?>" />
					<i class="fal fa-search form_icon"></i>
				</div>

				<div class="uc_uc">
					<? $staff = db::query("select * from user_staff where positions_id  = 6 order by ins_dt desc"); ?>
					<? if (mysqli_num_rows($staff)): ?>
						<? while ($buy_d = mysqli_fetch_assoc($staff)): ?>
							<? $user_d = fun::user($buy_d['user_id']); ?>
							<? $number++; ?>

							<div class="uc_ui edit_user_btn" data-id="<?=$user_d['id']?>">
								<div class="uc_uil">
									<div class="uc_ui_number"><?=$number?></div>
									<div class="uc_uiln" >
										<div class="uc_ui_icon lazy_img" data-src="/assets/uploads/users/<?=$user_d['img']?>"><?=($user_d['img']!=null?'':'<i class="fal fa-user"></i>')?></div>
										<div class="uc_uinu">
											<div class="uc_ui_name"><?=$user_d['name']?> <?=$user_d['surname']?></div>
											<div class="uc_ui_phone fr_phone"><?=$user_d['phone']?></div>
										</div>
									</div>
								</div>
								<div class="uc_uib user_del" data-id="<?=$buy_d['id']?>">
									<div class="uc_uibo"><i class="fal fa-trash-alt"></i></div>
								</div>
							</div>
						<? endwhile ?>
					
					<? else: ?>
						<div class="ds_nr">
							<i class="fal fa-ghost"></i>
							<p>Ешкім жоқ</p>
						</div>
					<? endif ?>

				</div>
			</div>


		</div>
	</div>

<? include "../block/footer.php"; ?>

	
	<!-- user plus -->
	<div class="pop_bl pop_bl2 add_user">
		<div class="pop_bl_a add_user_back"></div>
		<div class="pop_bl_c">
			<div class="head_c">
				<h4>Курьерді қосу</h4>
				<div class="btn btn_dd add_user_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl">
				<div class="form_c">
					<div class="form_im ">
						<div class="form_span">Аты:</div>
						<input type="text" class="form_txt name" placeholder="" data-lenght="2">
						<i class="fal fa-text form_icon"></i>
					</div>
					<div class="form_im ">
						<div class="form_span">Телефон номері:</div>
						<input type="tel" class="form_txt phone fr_phone" placeholder="8 (000) 000-00-00" data-lenght="11">
						<i class="fal fa-mobile form_icon"></i>
					</div>
					<div class="form_im form_im_bn">
						<div class="btn add_user_send" data-cours-id="<?=$cours_id?>">
							<span>Қосу</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- user plus -->
	<div class="pop_bl pop_bl2 edit_user">
		<div class="pop_bl_a edit_user_back"></div>
		<div class="pop_bl_c">
			<div class="head_c">
				<h4>Курьерді өзгерту</h4>
				<div class="btn btn_dd edit_user_back"><i class="fal fa-times"></i></div>
			</div>
			<div class="pop_bl_cl edit_clp">
				
			</div>
		</div>
	</div>
