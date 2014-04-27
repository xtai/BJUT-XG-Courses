function nav_active($x){
  $("#nav_"+$x).addClass("active");
}
$(document).ready(function(){
  $('._t').html($('#_t').html());
});
$(window).scroll(function(){
  if ($(window).scrollTop()>300){
    $('#backt').css({'bottom':'3px'});
    $('#backt').slideDown('fast');
  }else{
    $('#backt').slideUp('fast');
  }
});
Messenger.options = {
  extraClasses: 'messenger-fixed messenger-on-bottom',
  theme: 'block'
}