<?php
  include_once "../app/bootstarp.php";
  if($_SESSION['xg_type'] == "admins"){
  	header("Location: ../");
  }else{
  	$View->show("mine", "我的课程 &middot; 选课指南", "2", "0");
  }
?>