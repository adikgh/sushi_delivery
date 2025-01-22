<div class="uacc">
   <div class="uacc_c">
      <div class="uacc_i">
         <div class="uacc_in">Фото:</div>
         <div class="uacc_ic">
            <div class="upl_logo">
               <?php if ($user['logo']): ?>
                  <div class="upl_logo_img lazy_img" data-src="/assets/img/users/<?=$user['logo']?>"></div>
               <?php else: ?>
                  <div class="upl_logo_img lazy_img" data-src="/assets/img/icons/princess_light-skin-tone_1f478-1f3fb_1f3fb.png"></div>
               <?php endif ?>
               <!-- <div class="upl_logo_c"><?=($user['logo']?'Фотоны жаңарту':'Фото қою')?></div> -->
            </div>
         </div>
      </div>
      <div class="uacc_i">
         <div class="uacc_in">Есіміңіз:</div>
         <div class="uacc_ic">
            <div class="form_im">
               <input type="text" class="form_im_txt name" placeholder="" data-lenght="3" data-sel="1" value="<?=$user['name']?>" data-val="<?=$user['name']?>" />
            </div>
         </div>
      </div>
      <div class="uacc_i">
         <div class="uacc_in">Тегіңіз:</div>
         <div class="uacc_ic">
            <div class="form_im">
               <input type="text" class="form_im_txt surname" placeholder="" data-lenght="3" data-sel="1" value="<?=$user['surname']?>" data-val="<?=$user['surname']?>" />
            </div>
         </div>
      </div>
      <div class="uacc_i">
         <div class="uacc_in">Жынысыңыз:</div>
         <div class="uacc_ic">
            <div class="form_im form_im_btn form_im_btn_clc sex" data-val="<?=$user['sex']?>">
               <div class="form_im_btn_i <?=($user['sex']==1?'form_im_btn_act':'')?>" data-val="1">
                  <i class="fal fa-mars"></i>
               </div>
               <div class="form_im_btn_i <?=($user['sex']==2?'form_im_btn_act':'')?>" data-val="2">
                  <i class="fal fa-venus"></i>
               </div>
            </div>
         </div>
      </div>
      <div class="uacc_i">
         <div class="uacc_in">Жасыңыз:</div>
         <div class="uacc_ic">
            <div class="form_im">
               <input type="tel" class="form_im_txt fr_age age" placeholder="18" data-lenght="2" data-sel="1" value="<?=$user['age']?>" data-val="<?=$user['age']?>" />
            </div>
         </div>
      </div>
      <div class="uacc_i">
         <div class="uacc_in">Электронды почтаңыз:</div>
         <div class="uacc_ic">
            <div class="form_im">
               <input type="text" class="form_im_txt mail" placeholder="Почта" data-lenght="6" data-sel="1" value="<?=$user['mail']?>" data-val="<?=$user['mail']?>" />
            </div>
         </div>
      </div>
      <div class="uacc_i">
         <div class="uacc_in">Телефон нөміріңіз:</div>
         <div class="uacc_ic">
            <div class="form_im">
               <input type="text" class="form_im_txt phone fr_phone" placeholder="8 (000) 000-00-00" data-lenght="6" data-sel="1" value="<?=$user['phone']?>" data-val="<?=$user['phone']?>" />
            </div>
         </div>
      </div>
      <div class="uacc_i">
         <div class="uacc_in">Құпия сөз:</div>
         <div class="uacc_ic">
            <div class="form_im">
               <input type="password" class="form_im_txt password" placeholder="" data-lenght="6" data-sel="1" data-eye="0" value="<?=$user['password']?>" data-val="<?=$user['password']?>" />
               <i class="far fa-eye-slash form_icon_pass"></i>
            </div>
         </div>
      </div>
   </div>
   <div class="uacc_b">
      <div class="btn btn_cl btn_ubd_acc">
         <i class="far fa-check"></i>
         <span>Сақтау</span>
      </div>
   </div>
</div>