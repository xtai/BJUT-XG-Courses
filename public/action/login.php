<?php
  include_once "../../app/bootstarp.php";
  if($User->login($_POST['username'], $_POST['password'], $_POST['type'])){
    header("Location: ../home.php");
  }else{
    header("Location: ../");
  }
?>