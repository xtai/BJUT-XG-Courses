<?php 
  include_once "../src/init.php";
  include_once "../src/user.php";
  if(!user()){
    header("Location: ../");
  }else{
    init("修改密码 &middot; 信管专业选课指南", "..");
    init_nav(5);
    include_once "../html/password.html";
    init_footer();
  }
?>