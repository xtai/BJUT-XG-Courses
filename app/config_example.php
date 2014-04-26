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
server {
  listen 80;
  server_name www.abc.com;
  root    .../xg/public;
  index   index.html index.php;
  if (!-f $request_filename){
    set $rule_0 1$rule_0;
  }
  if (!-d $request_filename){
    set $rule_0 2$rule_0;
  }
  if ($rule_0 = "21"){
    rewrite /.* /index.php last;
  }
  location / {
    index index.php index.html index.htm;
  }
  location ~ .php$ {
    fastcgi_pass 127.0.0.1:9000;
    fastcgi_index index.php;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    include fastcgi_params;
  }
}
====================================
*/