<?php
  include_once "../src/php/init.php";
  include_once "../src/php/user.php";
  if(!user()){
    header("Location: ../");
  }else{
    init("我的课表 &middot; 信管专业选课指南", "..");
    init_nav("31");
    include_once "../src/html/coming_soon.html";
    init_footer();
  }
?>