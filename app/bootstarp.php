<?php
  //Import All Classes
  ini_set("include_path", ".://Users/taixiaoyu/Sites/xg/app/"); 
  $path = "http://127.0.0.1/~taixiaoyu/xg/public";

  include_once "package/mysql.php";
  include_once "package/user.php";
  include_once "package/subjects.php";
  include_once "package/view.php";
  session_start();

  $Subject = new Subject($path);
  $User    = new User();
  $View    = new View($User, $Subject, $path);

?>