var s = new Array();
var d = new Array(0,0,0,0,0);
var n = 0;
var t = 0;
$(document).ready(function()
{
  /* Save Button
  $(".fixed_save_b").css("top", $(window).height()-55);
  */
  $("#top_div").hide();
  for(var i = 2; i <= 4; i++)
  {
    s[i]=parseInt($("#s_"+i+"_default").html());
    n += s[i];
    t += r[i];
  }
  update();
  $(window).scroll(function()
  {
    if($(window).scrollTop()>275)
    {
      $("#top_div").show();
    }
    else
    {
      $("#top_div").hide();
    }
    /* Save Button
    $(".fixed_save_b").css("top", $(window).height()-55);
    if(($(document.body).outerHeight(true)-$(window).scrollTop()-$(window).height()) > 81)
    {
      $(".fixed_save").show();
      //$(".fixed_save_b").html($(document.body).outerHeight(true)+","+$(window).scrollTop()+","+$(window).height());
      $(".bottom_save").css("visibility","hidden");
    }
    else
    {
      $(".fixed_save").hide();
      $(".bottom_save").css("visibility","visible");
    }
    */
  });
});
function update()
{
  n = 0;
  for(var i = 2; i <= 4; i++)
  {
    $("#s_"+i).html(s[i]);
    $("#s_"+i+"_t").html(s[i]);
    n += s[i];
    $(".progress-bar").attr("aria-valuenow","90");
    if(s[i] < r[i])
    {
      $("#l_"+i).html("<span class=\"label label-danger\"><span class=\"glyphicon glyphicon-remove\"></span> 未完成教学计划</span>");
      $("#l_"+i+"_t").html("<span class=\"label label-danger\"><span class=\"glyphicon glyphicon-remove\"></span> 未完成教学计划</span>");
      d[i] = 0;
    }
    else
    {
      $("#l_"+i).html("<span class=\"label label-success\"><span class=\"glyphicon glyphicon-ok\"></span> 已完成教学计划</span>");
      $("#l_"+i+"_t").html("<span class=\"label label-success\"><span class=\"glyphicon glyphicon-ok\"></span> 已完成教学计划</span>");
      d[i] = 1;
    }
  }
  $("#need").html(t);
  $("#already").html(n);
  a = 100*n/t;
  if(a >= 100 && d[2]+d[3]+d[4] == 3)
  {
    $("#progress-bar-div").removeClass("active");
    $("#progress-bar-div").removeClass("progress-striped");
    $("#progress-bar").removeClass("progress-bar-warning");
    $("#progress-bar").addClass("progress-bar-success");
    $("#sign-div").removeClass("glyphicon-exclamation-sign");
    $("#sign-div").addClass("glyphicon-ok");
    $("#alert-div").removeClass("alert-warning");
    $("#alert-div").addClass("alert-success");
    $("#p-div").html("已经完成教学计划了~");
  }
  else
  {
    $("#progress-bar-div").addClass("active");
    $("#progress-bar-div").addClass("progress-striped");
    $("#progress-bar").addClass("progress-bar-warning");
    $("#progress-bar").removeClass("progress-bar-success");
    $("#sign-div").addClass("glyphicon-exclamation-sign");
    $("#sign-div").removeClass("glyphicon-ok");
    $("#alert-div").addClass("alert-warning");
    $("#alert-div").removeClass("alert-success");
    $("#p-div").html("尚未完成教学计划");
  }
  $("#progress-bar").css("width", a+"%");
}
function change_val($x,$y,$z)
{
  if($y == 1)
  {
    return;
  }
  else if(document.getElementById("box" + $x).checked)
  {
    change_ajax($x, "delete");
    s[$y]-=$z;
    document.getElementById("box" + $x).checked = false;
    $("#"+$x).removeClass("checked");
    $("#enroll_"+$x).html(parseInt($("#enroll_"+$x).html())-1);
    update();
  }
  else
  {
    change_ajax($x, "insert");
    s[$y]+=$z;
    $("#"+$x).addClass("checked");
    document.getElementById("box"+$x).checked = true;
    $("#enroll_"+$x).html(parseInt($("#enroll_"+$x).html())+1);
    update();
  }
}
function change_val_2($x,$y,$z){
  if($y == 1)
  {
    return;
  }
  else if(document.getElementById("box"+$x).checked)
  {
    document.getElementById("box" + $x).checked = false;
  }
  else
  {
    document.getElementById("box" + $x).checked = true;
  }
}
function avoid_val($x,$y,$z){
  if($y == 1)
  {
    return;
  }
  else
  {
    change_val($x,$y,$z)
  }
}
function change_ajax($x, $y)
{
  $title = $("#title" + $x).html();
  $.post('./action/change.php', {sid: $x, option: $y}, function(data)
  {
    if(data)
    {
      if($y == "insert"){
        Messenger().post(
        {
          type: "success",
          hideAfter: 4,
          showCloseButton: true,
          message: "<strong>"+$title+"</strong> 已选"
        });
      }
      else if($y == "delete")
      {
        Messenger().post(
        {
          type: "error",
          hideAfter: 4,
          showCloseButton: true,
          message: "<strong>"+$title+"</strong> 已退选"
        });
      }
    }
  });
}