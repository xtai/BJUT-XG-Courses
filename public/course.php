<?php
  include_once "../app/bootstarp.php";
  if($_SESSION['xg_type'] == "admins"){
  	$View->show("admin_course", "课程管理 &middot; 信管专业选课指南", "2", "2");
  }else{
  	header("Location: ../");
  }
?>