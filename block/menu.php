<? if ($site_set['menu']): ?>
   <div class="pmenu">
		<div class="pmenu_c">
			<? if ($super == 6): ?>
				<a class="pmenu_i txt_c <?=($menu_name=='new'?'pmenu_i_act':'')?>" href="/orders/?sort=new">
					<i class="far fa-list-ol"></i>
					<span>Жаңа</span>
				</a>
				<a class="pmenu_i <?=($menu_name=='history'?'pmenu_i_act':'')?>" href="/orders/?sort=history">
					<i class="far fa-clipboard-list-check"></i>
					<span>Тапсырылған</span>
				</a>
			<? endif ?>
			<? if ($super == 3 || $user_right['positions_id'] == 2 || $user_right['positions_id'] == 1): ?>
				<a class="pmenu_i txt_c <?=($menu_name=='new'?'pmenu_i_act':'')?>" href="/orders/list.php?sort=new">
					<i class="far fa-list-ol"></i>
					<span>Таңдалмаған</span>
				</a>
				<a class="pmenu_i <?=($menu_name=='history'?'pmenu_i_act':'')?>" href="/orders/list.php?sort=history">
					<i class="far fa-clipboard-list-check"></i>
					<span>Дайын</span>
				</a>
				<a class="pmenu_i <?=($menu_name=='myself'?'pmenu_i_act':'')?>" href="/orders/list.php?sort=myself">
					<i class="far fa-hand-receiving"></i>
					<span>Собой</span>
				</a>
			<? endif ?>

			<a class="pmenu_i <?=($menu_name=='acc'?'pmenu_i_act':'')?>" href="/acc/">
				<i class="far fa-user"></i>
				<span>Аккаунт</span>
			</a>
		</div>
   </div>
<? endif ?>