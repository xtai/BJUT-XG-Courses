<?php
  include_once "./src/php/init.php";
  include_once "./src/php/user.php";

  //test code
  //git clone again
  //and add test code 
  //pull request
  echo get_current_user();

  if(user()){
    header("Location: ./view/home.php");
  }else{
    init_bg("1");
    init("信管专业选课指南", ".");
    include_once "./src/html/login.html";
    init_footer();
  }
?>