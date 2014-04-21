<?php
  include_once "../app/bootstarp.php";
  if($_SESSION['xg_type'] == "admins"){
  	$name = $Subject->subject($_GET['i'],"name");
  	$View->show("admin_subject", $name." &middot; 信管专业选课指南", "0", "2");
  }else{
  	$name = $Subject->subject($_GET['i'],"name");
  	$View->show("subject", $name." &middot; 信管专业选课指南", "0", "0");
  }
?>