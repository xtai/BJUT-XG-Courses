<?php
  include_once "../src/php/init.php";
  include_once "../src/php/user.php";
  if(!user()){
    header("Location: ../view/home.php");
  }else{
    include_once "../src/php/subjects.php";
    init("大家选的课 &middot; 信管专业选课指南", "..");
    init_nav("2");
    include_once "../src/html/coming_soon.html";
    init_footer();
  }
?>