<?php
  include_once "../../app/bootstarp.php";
  if($User->login($_POST['username'], $_POST['password'], $_POST['type'])){
  	if($_POST['type'] == 'users'){
      header("Location: ../home.php");
  	}elseif($_POST['type'] == 'admins'){
  	  header("Location: ../admin/home.php");
  	}
  }else{
    if($_POST['type'] == 'users'){
      header("Location: ../");
    }elseif($_POST['type'] == 'admins'){
      header("Location: ../admin/");
    }
  }
?>