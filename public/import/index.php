<?php
  include_once "../../app/bootstarp.php";
  if($_SESSION['xg_type'] == "admins"){
  	$View->show("admin_import", "导入向导 &middot; 选课指南", "6", "2");
  }else{
  	header("Location: ../");
  }
?>