function c()
{
  $value_1 = $("#password1").val();
  $value_2 = $("#password2").val();
  if($value_1 == $value_2 && $value_1 == "")
  {
    $("#button").val("先输新密码吧");
    $("#button").attr("disabled","");
  }
  else if($value_1 == $value_2)
  {
    $("#button").val("记住了按这里");
    $("#button").removeAttr("disabled");
  }
  else
  {
    $("#button").val("两次不一样啊!");
    $("#button").attr("disabled","");
  }
}