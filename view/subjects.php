<?php
  include_once "../src/init.php";
  include_once "../src/user.php";
  if(!user()){
    header("Location: ../home.php");
  }else{
    include_once "../src/subjects.php";
    init("大家选的课 &middot; 信管专业选课指南", "..");
    init_nav("2");
    include_once "../html/coming_soon.html";
    init_footer();
  }
?>