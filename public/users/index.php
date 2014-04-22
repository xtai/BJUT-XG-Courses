<?php
  include_once "../../app/bootstarp.php";
  if($_SESSION['xg_type'] == "admins"){
  	$View->show("admin_users", "用户管理 &middot; 选课指南", "2", "2");
  }else{
  	header("Location: ../");
  }
?>