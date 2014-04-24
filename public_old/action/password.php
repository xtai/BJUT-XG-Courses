<?php
  include_once "../../app/bootstarp.php";
  $User->change_password($_POST['password']);
  header("Location: ./logout.php");
?>