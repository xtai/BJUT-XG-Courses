<?php
//initalizae functions
  $page_title;
  $page_path;
  $page_bg;
  $page_nav;
  $con;
  session_start();
  ini_set("date.timezone","Asia/Hong_Kong");
  //insert webpage header and initalizae gloabl path for every script to run
  function init($title, $path)
  {
    global $page_title, $page_path, $page_bg;
    $page_title = $title;
    $page_path = $path;
    init_mysql();
    include_once "$page_path/src/html/header.html";
  }
  //initalizae webpage background, for login page in dark background
  function init_bg($x)
  {
    global $page_bg;
    $page_bg = $x;
  }
  //initalizae mysql service
  function init_mysql()
  {
    global $page_path;
    include_once "$page_path/src/php/mysql.php";//connect mysql service
  }
  //insert navbar and set current active page
  function init_nav($x)
  {
    global $page_path, $page_nav;
    $page_nav = $x;
    include_once "$page_path/src/html/navbar.html";
  }
  //insert webpage footer
  function init_footer()
  {
    global $page_path, $page_bg, $con;
    include_once "$page_path/src/html/footer.html";
    mysql_close($con);
  }
  //initalizae for subject.html view
  function init_subject($title, $path)
  {
    global $page_title,$page_path;
    $page_path = $path;
    init_mysql();
    $page_title = subject($title,"name")." &middot; 信管专业选课指南";
    include_once "$page_path/src/html/header.html";
  }
?>