<?php
  include_once "../src/php/init.php";
  include_once "../src/php/user.php";
  if(!user()){
    header("Location: ../");
  }else{
    init("教学计划 &middot; 信管专业选课指南", "..");
    init_nav("4");
    include_once "../src/html/coming_soon.html";
    init_footer();
  }
?>