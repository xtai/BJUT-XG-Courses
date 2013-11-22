<?php 
  include_once "../src/php/init.php";
  include_once "../src/php/user.php";
  if(!user()){
    header("Location: ../");
  }else{
    include_once "../src/php/subjects.php";
    init("所有课程 &middot; 信管专业选课指南", "..");
    init_nav("1");
    include_once "../src/html/home.html";
    init_footer();
  }
?>