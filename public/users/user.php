<?php
  include_once "../../app/bootstarp.php";
  if($_SESSION['xg_type'] == "admins"){
  	//$name = $Admin->subject($_GET['u'],"name");
  	$View->show("admin_user", $name." &middot; 选课指南", "0", "2");
  }else{
  	header("Location: ../");
  }
?>