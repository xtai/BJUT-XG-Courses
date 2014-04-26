<?php
/**
* Configuration Example
* to make this working using: config.php
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.26
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*
* including Apache & Nginx rewrite rules, to make router working.
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

/*
====================================
Apache Rewrite Rules Here:
  a .htaccess file was
  included in /../public/
------------------------------------
Options +FollowSymLinks
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [L]
====================================
Nginx Sever Example Here
------------------------------------

Pending!

====================================
*/