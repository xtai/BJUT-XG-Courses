<?php
  include_once "../src/php/init.php";
  $page_path = "..";
  init_mysql();
  include_once "../src/php/user.php";
  if(login($_POST['username'],$_POST['password'])){
    mysql_close($con);
    header("Location: ../view/home.php");
  }else{
    mysql_close($con);
    header("Location: ../");
  }
?>