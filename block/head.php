<? $menu = mysqli_fetch_array(db::query("select * from `site_menu` where name = '$menu_name' and type = 'admin'")); ?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0"/> -->

<title><?=@$menu['title_'.$lang]?> | <?=@$site['name']?></title>
<meta name="description" content="<?=@$menu['disc_'.$lang]?> <?=@$site['phone_view']?>">
<meta name="keywords" content="<?=@$menu['keyw_'.$lang]?>">
<meta name="theme-color" content="<?=@$site['color']?>">

<!-- icon -->
<link rel="icon" href="/assets/img/logo/icon.png" type="image/x-icon">
<link rel="shortcut icon" type="image/icon" href="/assets/img/logo/icon.png">

<!-- Open Graph -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://<?=$site['site']?>.kz" />
<meta property="og:site_name" content="<?=$site['name']?>" />
<meta property="og:title" content="<?=$menu['title_'.$lang]?> | <?=$site['name']?>" />
<meta property="og:description" content="<?=$menu['disc_'.$lang]?> <?=$site['phone_view']?>" />
<meta property="og:image" content="/assets/img/logo/logo.jpg" />

<!-- apple -->
<meta name="application-name" lang="<?=$lang?>" content="<?=$site['site']?>">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

<!-- ms -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="cleartype" content="on">
<meta name="msapplication-tooltip" content="<?=$menu['title_'.$lang]?> | <?=$site['name']?>">
<meta name="msapplication-TileColor" content="<?=@$site['color']?>">
<meta name="msapplication-starturl" content="https://<?=$site['site']?>">


<!-- css -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap" />
<link rel="stylesheet" href="/assets/pl/fontawesome/css/all.min.css" />
<link rel="stylesheet" type="text/css" href="/assets/css/anim.css?v=<?=$ver?>" />
<? if (@$site_set['swiper'] == true): ?> <link rel="stylesheet" href="/assets/pl/swiper-bundle.min.css" /> <? endif ?>
<? if (@$site_set['plyr'] == true): ?> <link rel="stylesheet" href="/assets/pl/plyr.css" /> <? endif ?>

<!-- main css -->
<? foreach ($scss as $i): ?> <link rel="stylesheet" type="text/css" href="/assets/css/<?=$i?>.css?v=<?=$ver?>" /> <? endforeach ?>
<? foreach ($css as $i): ?> <link rel="stylesheet" type="text/css" href="/assets/css/<?=$i?>.css?v=<?=$ver?>" /> <? endforeach ?>


<!-- js -->
<script src="/assets/pl/jquery.min.js"></script>
<script src="/assets/pl/jquery.lazy.min.js"></script>
<script src="/assets/pl/jquery.lazy.plugins.min.js"></script>
<script src="/assets/pl/jquery.mask.min.js"></script>
<? if (@$site_set['swiper'] == true): ?> <script src="/assets/pl/swiper-bundle.min.js"></script> <? endif ?>
<? if (@$site_set['plyr'] == true): ?> <script src="/assets/pl/plyr.polyfilled.js"></script> <? endif ?>
<? if (@$site_set['aos'] == true): ?> <script src="/assets/pl/aos.js"></script> <? endif ?>
<? if (@$site_set['autosize'] == true): ?> <script src="/assets/pl/autosize.min.js"></script> <? endif ?>
<script src="/assets/js/fun.js?v=<?=$ver?>"></script>

