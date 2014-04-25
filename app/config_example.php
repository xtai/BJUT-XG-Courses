<?php
  /**
  * XG-Courses Setting Example
  * by Xiaoyu Tai @ Beijing, 2014.4.12
  */

  // $path --> change it when app runs in relative path like domain.com/sub/
  $path             = "http://".$_SERVER['SERVER_NAME'];
  // $base_file_path --> change it when 'app' folder base path wrong. e.g. .:/var/www/xg/app
  $base_file_path   = __DIR__;

  $db_location      = "server";   //--> database settings
  $db_username      = "username"; //^
  $db_password      = "password"; //^
  $db_database      = "database"; //^

  $google_analytics = "";         //--> Google Analytics Tracking ID
?>