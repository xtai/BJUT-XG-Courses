var s = new Array();
var r = new Array(0,32,9,8,12);
$(document).ready(function(){
  $(".fixed_save_b").css("top",$(window).height()-55);
  $("#top_div").hide();
  for(var i = 2; i <= 4; i++){
    s[i]=parseInt($("#s_"+i+"_default").html());
    update();
  }
  $(window).scroll(function(){
    $(".fixed_save_b").css("top",$(window).height()-55);
    if($(window).scrollTop()>111){
      $("#top_div").show();
    }else{
      $("#top_div").hide();
    }
    if(($(document.body).outerHeight(true)-$(window).scrollTop()-$(window).height())>81){
      $(".fixed_save").show();
      //$(".fixed_save_b").html($(document.body).outerHeight(true)+","+$(window).scrollTop()+","+$(window).height());
      $(".bottom_save").css("visibility","hidden");
    }else{
      $(".fixed_save").hide();
      $(".bottom_save").css("visibility","visible");
    }
  });
});
function update(){
  for(var i = 2; i <= 4; i++){
    $("#s_"+i).html(s[i]);
    $("#s_"+i+"_t").html(s[i]);
    if(s[i] < r[i]){
      $("#l_"+i).html("<span class=\"label label-danger\"><span class=\"glyphicon glyphicon-remove\"></span> 未完成教学计划</span>");
      $("#l_"+i+"_t").html("<span class=\"label label-danger\"><span class=\"glyphicon glyphicon-remove\"></span> 未完成教学计划</span>");
    }else{
      $("#l_"+i).html("<span class=\"label label-success\"><span class=\"glyphicon glyphicon-ok\"></span> 已完成教学计划</span>");
      $("#l_"+i+"_t").html("<span class=\"label label-success\"><span class=\"glyphicon glyphicon-ok\"></span> 已完成教学计划</span>");
    }
  }
}
function change_val($x,$y,$z){
  if($y == 1){
    return;
  }else if(document.getElementById("box"+$x).checked){
    s[$y]-=$z;
    document.getElementById("box"+$x).checked=false;
    $("#"+$x).removeClass("checked");
    $("#enroll_"+$x).html(parseInt($("#enroll_"+$x).html())-1);
    update();
  }else{
    s[$y]+=$z;
    $("#"+$x).addClass("checked");
    document.getElementById("box"+$x).checked=true;
    $("#enroll_"+$x).html(parseInt($("#enroll_"+$x).html())+1);
    update();
  }
}
function change_val_2($x,$y,$z){
  if($y == 1){
    return;
  }else if(document.getElementById("box"+$x).checked){
    document.getElementById("box"+$x).checked=false;
  }else{
    document.getElementById("box"+$x).checked=true;
  }
}
function avoid_val($x,$y,$z){
  if($y == 1){
    return;
  }else{
    change_val($x,$y,$z)
  }
}