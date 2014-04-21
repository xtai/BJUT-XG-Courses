<?php
  /**
  * XG-Courses Bootstrap
  * by Xiaoyu Tai @ Beijing, 2014.3
  */

  //!IMPORTANT: see setting_example.php
  include_once "setting.php";

  //Set Path & Import All Classes
  ini_set("include_path", $include_path); 
  
  include_once "package/mysql.php";
  include_once "package/user.php";
  include_once "package/subjects.php";
  include_once "package/view.php";

  session_start();

  $MySQL   = new MySQL($db_location, $db_username, $db_password, $db_database);
  $User    = new User($MySQL);
  $Subject = new Subject($MySQL, $User, $path);
  $View    = new View($MySQL, $User, $Subject, $path);
?>