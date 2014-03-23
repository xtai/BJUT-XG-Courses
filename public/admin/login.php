<?php
  include_once "../src/php/init.php";
  include_once "../src/php/admin.php";
  if(admin()){
    header("Location: ./admin.php");
  }else{
    init_bg("3");
    init("后台管理 &middot; 信管专业选课指南", "..");
    include_once "../src/html/admin_login.html";
    init_footer();
  }
?>