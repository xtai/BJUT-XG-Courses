<?php 
  include_once "../src/init.php";
  include_once "../src/user.php";
  if(!user()){
    header("Location: ../");
  }else{
    include_once "../src/subjects.php";
    init("信管专业选课指南", "..");
    init_nav("1");
    include_once "../html/home.html";
    init_footer();
  }
?>