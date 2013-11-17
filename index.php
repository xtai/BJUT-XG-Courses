<?php
  include_once "./src/init.php";
  include_once "./src/user.php";
  if(user()){
    header("Location: ./view/home.php");
  }else{
    init_bg("1");
    init("信管专业选课指南", ".");
    include_once "./html/signin.html";
    init_footer();
  }
?>