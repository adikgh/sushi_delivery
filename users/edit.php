<? include "../config/core.php"; ?>

   <!--  -->
   <? if (isset($_GET['user_edit'])): ?>
		<? $user_ed = fun::user(strip_tags($_POST['id'])); ?>

        <div class="form_c">
            <div class="form_im ">
                <div class="form_span">Аты:</div>
                <input type="text" class="form_txt edit_name" placeholder="" data-lenght="2" value="<?=$user_ed['name']?>">
                <i class="fal fa-text form_icon"></i>
            </div>
            <div class="form_im ">
                <div class="form_span">Телефон номері:</div>
                <input type="tel" class="form_txt edit_phone fr_phone" placeholder="8 (000) 000-00-00" data-lenght="11" value="<?=$user_ed['phone']?>">
                <i class="fal fa-mobile form_icon"></i>
            </div>
            <div class="form_im form_im_bn">
                <div class="btn edit_user_send" data-id="<?=$user_ed['id']?>">
                    <span>Өзгерту</span>
                </div>
            </div>
        </div>

		<? exit(); ?>
	<? endif ?>








