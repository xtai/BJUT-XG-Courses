<?php
  include_once "../src/php/init.php";
  include_once "../src/php/user.php";
  if(!user()){
    header("Location: ../");
  }else{
    init("留言板 &middot; 信管专业选课指南", "..");
    init_nav("6");
    include_once "../src/html/message.html";
    init_footer();
  }
?>