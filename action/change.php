<?php
  include_once "../src/php/init.php";
  $page_path = "..";
  init_mysql();
  include_once "../src/php/subjects.php";
  echo ajax_change($_POST['sid'], $_POST['option']);
?>