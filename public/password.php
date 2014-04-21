<?php
  include_once "../app/bootstarp.php";
  if($_SESSION['xg_type'] == "admins"){
  	$View->show("password", "修改密码 &middot; 信管专业选课指南", "5", "2");
  }else{
  	$View->show("password", "修改密码 &middot; 信管专业选课指南", "5", "0");
  }
?>