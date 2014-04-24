<?php
  include_once "../../app/bootstarp.php";
  if($_SESSION['xg_type'] == "admins"){
  	$View->show("admin_plan", "教学计划管理 &middot; 选课指南", "4", "2");
  }else{
  	$View->show("plan", "教学计划 &middot; 选课指南", "3", "0");
  }
?>