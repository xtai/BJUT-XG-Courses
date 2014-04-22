<?php
  include_once "../app/bootstarp.php";
  if($_SESSION['xg_type'] == "admins"){
  	header("Location: ../");
  }else{
  	$View->show("message", "留言板 &middot; 选课指南", "4", "0");
  }
?>