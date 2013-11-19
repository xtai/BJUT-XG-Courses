<?php
  include_once "../src/init.php";
  include_once "../src/user.php";
  $page_path="..";
  init_mysql();
  password($_POST[password]);
  header("Location: ./logout.php");
?>