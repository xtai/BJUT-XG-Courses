<?php
  $page_title;
  $page_path;
  $page_bg;
  $page_nav;
  session_start();
  function init($title, $path){
    global $page_title, $page_path, $page_bg;
    $page_title = $title;
    $page_path = $path;
    init_mysql();
    include_once "$page_path/src/html/header.html";
  }
  function init_bg($x){
    global $page_bg;
    $page_bg = $x;
  }
  function init_mysql(){
    global $page_path;
    include_once "$page_path/src/php/mysql.php";
  }
  function init_nav($x){
    global $page_path, $page_nav;
    $page_nav = $x;
    include_once "$page_path/src/html/navbar.html";
  }
  function init_footer(){
    global $page_path, $page_bg;
    include_once "$page_path/src/html/footer.html";
  }
  function init_subject($title, $path){
    global $page_title,$page_path;
    $page_path = $path;
    init_mysql();
    $page_title = subject($title,"name")." &middot; 信管专业选课指南";
    include_once "$page_path/src/html/header.html";
  }
?>