<?php
  include_once "../app/bootstarp.php";
  $name = $Subject->subject($_GET['i'],"name");
  $View->show("subject", $name." &middot; 信管专业选课指南", "0", "0");
?>