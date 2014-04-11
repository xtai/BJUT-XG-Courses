<?php
  /**
  * XG-Courses Bootstrap
  * by Xiaoyu Tai @ Beijing, 2014.3
  */

  include_once "setting.php";
  /**
  * setting.php example:
  * <?php
  *   $include_path = "";        --> 'app' folder base path e.g. .:/var/www/xg/app
  *   $path = "";                --> website base path e.g. xg.taixiaoyu.com
  *
  *   $db_location = "server";   --> database settings
  *   $db_username = "username"; ^
  *   $db_password = "password"; ^
  *   $db_database = "database"; ^
  * ?>
  */
  ini_set("include_path", $include_path); 

  //Import All Classes
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