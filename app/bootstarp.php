<?php
  //Import All Classes
  ini_set("include_path", ".://var/www/xg/public/"); 
  $path = "http://xg.taixiaoyu.com";

  $db_location = "localhost";
  $db_username = "tai";
  $db_password = "12345678";
  $db_database = "xg_courses";


  include_once "package/mysql.php";
  include_once "package/user.php";
  include_once "package/subjects.php";
  include_once "package/view.php";
  session_start();

  $MySQL   = new MySQL($db_location, $db_username, $db_password, $db_database);
  $Subject = new Subject($MySQL, $path);
  $User    = new User($MySQL);
  $View    = new View($MySQL, $User, $Subject, $path);

?>