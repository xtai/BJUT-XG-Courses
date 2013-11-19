function nav_active($x){
  $("#nav_"+$x).addClass("active");
  if($x==31||$x==32){
    $("#nav_3").addClass("active");
  }
}
$(document).ready(function(){
  $('#search').show();
  $(window).scroll(function(){
    if ($(window).scrollTop()>300){
      $('#backt').css({'bottom':'3px'});
      $('#backt').slideDown('fast');
    }else{
      $('#backt').slideUp('fast');
    }
  });
});