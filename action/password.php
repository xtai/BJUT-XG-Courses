<?php
  include_once "../src/php/init.php";
  include_once "../src/php/user.php";
  $page_path="..";
  init_mysql();
  password($_POST['password']);
  mysql_close($con);
  header("Location: ./logout.php");
?>