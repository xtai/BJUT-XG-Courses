<?php
  include_once "../src/init.php";
  include_once "../src/user.php";
  if(!user()){
    header("Location: ../home.php");
  }else{
    include_once "../src/subjects.php";
    init_subject($_GET[i], "..");
    init_nav("6");
    include_once "../html/subject.html";
    init_footer();
  }
?>