<?php
//functions for MySQL connect and disconnect
  global $con;
  $mysql_location = "localhost";
  $mysql_username = "tai";
  $mysql_password = "12345678";
  $mysql_database = "xg_courses";
  //connecting mysql
  $con = mysql_connect($mysql_location, $mysql_username, $mysql_password);
  if(!$con)
  {
    die("Could not connect: " . mysql_error());
  } 
  mysql_query("SET NAMES UTF8;");
  mysql_select_db($mysql_database, $con);
  date_default_timezone_set("Asia/Hong_Kong");
?>