<?php
  include_once "../src/init.php";
  $page_path="..";
  init_mysql();
  include_once "../src/user.php";
  if(login($_POST[username],$_POST[password])){
    header("Location: ../view/home.php");
  }else{
    header("Location: ../");
  }
?>