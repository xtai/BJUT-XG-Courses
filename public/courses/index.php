<?php
  include_once "../../app/bootstarp.php";
  if($_SESSION['xg_type'] == "admins"){
  	$View->show("admin_course", "课程管理 &middot; 选课指南", "3", "2");
  }else{
  	header("Location: ../");
  }
?>