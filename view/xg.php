<?php
  include_once "../src/init.php";
  include_once "../src/user.php";
  if(!user()){
    header("Location: ../home.php");
  }else{
    init("专业课表 &middot; 信管专业选课指南", "..");
    init_nav("32");
    include_once "../html/coming_soon.html";
    init_footer();
  }
?>