<?php
  include_once "../app/bootstarp.php";
  if($_SESSION['xg_type'] == "admins"){
  	$View->show("admin_plan", "教学计划管理 &middot; 信管专业选课指南", "3", "2");
  }else{
  	$View->show("plan", "教学计划 &middot; 信管专业选课指南", "3", "0");
  }
?>