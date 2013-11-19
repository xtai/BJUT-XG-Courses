<?php
  include_once "../src/php/init.php";
  include_once "../src/php/user.php";
  if(!user()){
    header("Location: ../");
  }else{
    include_once "../src/php/subjects.php";
    init_subject($_GET[i], "..");
    init_nav("6");
    include_once "../src/html/subject.html";
    init_footer();
  }
?>