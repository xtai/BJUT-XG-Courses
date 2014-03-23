var s = new Array();
var r = new Array(0,32,9,8,12);
var d = new Array(0,0,0,0,0);
var n = 0;
var t = 0;
$(document).ready(function()
{
  $("#top_div").hide();
  for(var i = 2; i <= 4; i++)
  {
    s[i] = parseInt($("#s_"+i+"_default").html());
    n += s[i];
    t += r[i];
  }
  update();
  $(window).scroll(function()
  {
    $(".fixed_save_b").css("top", $(window).height()-55);
    if($(window).scrollTop()>229)
    {
      $("#top_div").show();
    }
    else
    {
      $("#top_div").hide();
    }
  });
});
function update()
{
  for(var i = 2; i <= 4; i++)
  {
    $("#s_"+i).html(s[i]);
    $("#s_"+i+"_t").html(s[i]);
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
  $("#progress-bar").css("width", a+"%");
}