<?php 
  include_once "../src/php/init.php";
  include_once "../src/php/user.php";
  if(!user()){
    header("Location: ../");
  }else{
    init("修改密码 &middot; 信管专业选课指南", "..");
    init_nav("5");
    include_once "../src/html/password.html";
    init_footer();
  }
?>