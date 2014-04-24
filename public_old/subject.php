<?php
  include_once "../app/bootstarp.php";
  if($_SESSION['xg_type'] == "admins"){
  	header("Location: ../");
  }else{
  	$name = $Subject->subject($_GET['i'],"name");
  	$View->show("subject", $name." &middot; 选课指南", "0", "0");
  }
?>