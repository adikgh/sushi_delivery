function mess(e) {
   $('.bl_mess').addClass('bl_mess_zak')
   $('.bl_mess_sam').html(e)
   setTimeout(function(){$('.bl_mess').removeClass('bl_mess_zak')},6000)
}
$('.bl_mess').on('click',function(){$(this).removeClass('bl_mess_zak')})









// 
function copytext(e) {
	var $tmp = $("<input>");
	$("body").append($tmp);
	$tmp.val(e).select();
	document.execCommand("copy");
	$tmp.remove();
   mess('Cәтті көшірілді!');
}


// 
function clcBack(e) {
	history.back();
}
function clcPP(e) {
	window.history.forward();
}
function clcP2(e) {
	history.go();
}