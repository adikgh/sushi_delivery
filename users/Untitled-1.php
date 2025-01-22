<?php if (mysqli_num_rows($pack) > 1): ?>
						<?php while ($pack_d = mysqli_fetch_assoc($pack)): ?>
							<a class="swiper-slide ucours_tm_i <?=($_GET['pack_id']==$pack_d['id']?'ucours_tm_act':'')?>" href="/user/item/users/?id=<?=$cours_id?>&pack_id=<?=$pack_d['id']?>">
								<?=$pack_d['name']?> <?=($_GET['pack_id']==$pack_d['id']?'('.mysqli_num_rows($cours_sub_num).')':'')?>
							</a>
						<?php endwhile ?>
					<?php endif ?>

							<!-- <div class="ucours_t">
			<div class="ucours_tm">
				<a class="ucours_tm_i <?=($filter==0?'ucours_tm_act':'')?>" href="/user/cours/item/users/?id=<?=$cours_id?>">Барлығы</a>
				<a class="ucours_tm_i <?=($_GET['on']==1?'ucours_tm_act':'')?>" href="/user/cours/item/users/?id=<?=$cours_id?>&on=1">Қосулы <?=($_GET['on']==1?'('.mysqli_num_rows($cours_sub_num).')':'')?></a>
				<a class="ucours_tm_i <?=($_GET['off']==1?'ucours_tm_act':'')?>" href="/user/cours/item/users/?id=<?=$cours_id?>&off=1">Жабық <?=($_GET['off']==1?'('.mysqli_num_rows($cours_sub_num).')':'')?></a>
				<div class="pop_btn ">
					<div class="btn btn_cm">
						<i class="far fa-user-plus"></i>
						<span>Оқушыны қосу</span>
					</div>
				</div>
			</div>
		</div> -->

		// Оқушылар тізімі
	// $filter = 1;
	// if (isset($_GET['pack_id']) || $_GET['pack_id'] != '') {
	// 	$pack_id = $_GET['pack_id'];
	// 	$cours_buy = db::query("select * from c_buy where cours_id = '$cours_id' and pack_id = '$pack_id' order by ins_dt desc limit 50");
	// 	$cours_sub_num = db::query("select * from c_buy where cours_id = '$cours_id' and pack_id = '$pack_id' order by ins_dt desc");
	// } elseif ($_GET['on'] == 1) {
	// 	$cours_buy = db::query("select * from c_buy where cours_id = '$cours_id' and off is null order by ins_dt desc limit 50");
	// 	$cours_sub_num = db::query("select * from c_buy where cours_id = '$cours_id' and off is null order by ins_dt desc");
	// } elseif ($_GET['off'] == 1) {
	// 	$cours_buy = db::query("select * from c_buy where cours_id = '$cours_id' and off is not null order by ins_dt desc limit 50");
	// 	$cours_sub_num = db::query("select * from c_buy where cours_id = '$cours_id' and off is not null order by ins_dt desc");
	// } else {
	// 	$cours_buy = db::query("select * from c_buy where cours_id = '$cours_id' order by ins_dt desc limit 50");
	// 	$filter = 0;
	// }
