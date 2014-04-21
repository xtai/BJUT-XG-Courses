<?php
  include_once "../app/bootstarp.php";
  if($_SESSION['xg_type'] == "admins"){
  	$View->show("admin_users", "用户管理 &middot; 信管专业选课指南", "1", "2");
  }else{
  	header("Location: ../");
  }
?>