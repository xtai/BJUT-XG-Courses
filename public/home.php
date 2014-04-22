<?php 
  include_once "../app/bootstarp.php";
  if($_SESSION['xg_type'] == "admins"){
  	$View->show("admin_home", "后台管理 &middot; 选课指南", "1", "2");
  }else{
  	$View->show("home", "所有课程 &middot; 选课指南", "1", "0");
  }
?>