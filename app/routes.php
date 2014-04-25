<?php
/**
*
* routes for all websies
*
* author: Xiaoyu Tai @ Beijing, 2014.4.25
*
*/

$router->set404(function() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  echo "<html><head><meta charset=\"utf-8\"><meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"><title>404 Not Found</title></head><body><center style=\"margin-top: 60px; font-size:30px; color:#999; font-weight:100;\">404 Not Found</center><center style=\"margin-top: 20px; font-size:100px; color:#333; font-weight:100;\">: (</center></body>";
});
$router->before("GET|POST", "/(.*)", function($url) {
  if(!isset($_SESSION["xg_user_type"]) && $url != "login" && !preg_match("/admin/", $url) && $url != "mit"){
    header("location: /login/");
    exit();
  }elseif(isset($_SESSION["xg_user_type"])){
    if($_SESSION["xg_user_type"] == "admins" && !preg_match("/admin/", $url) && $url != "mit"){
      header("location: /admin/");
      exit();
    }
  }
});
$router->before("GET|POST", "/admin(.*)", function($url) {
  if(!isset($_SESSION["xg_user_type"]) && $url != "login"){
    header("location: /admin/login/");
    exit();
  }elseif(isset($_SESSION["xg_user_type"])){
    if($_SESSION["xg_user_type"] == "users"){
      header("location: /");
      exit();
    }elseif($url == "login"){
      header("location: /admin/");
      exit();
    }
  }
});
$router->get("/mit", function(){
  $View = new \View\View(null, null, null);
  $View->show("mit");
});
$router->get("/login", function(){
  $View = new \View\View("选课指南", "1", null);
  $View->show("login");
});
$router->post("/login", function(){
  $MoudleUser = new \Moudle\MoudleUser();
  $MoudleUser->login($_POST["username"], $_POST["password"]);
  header("location: /");
});
$router->get("/logout", function(){
  $MoudleUser = new \Moudle\MoudleUser();
  $MoudleUser::logout();
  header("location: /login/");
});
$router->get("/admin/login", function(){
  $View = new \View\View("后台登陆", "3", null);
  $View->show("admin_login");
});
$router->post("/admin/login", function(){
  $MoudleAdmin = new \Moudle\MoudleAdmin();
  $MoudleAdmin->login($_POST["username"], $_POST["password"]);
  header("location: /admin/");
});
$router->get("/admin/logout", function(){
  $MoudleAdmin = new \Moudle\MoudleAdmin();
  $MoudleAdmin::logout();
  header("location: /admin/login/");
});
$router->get("/admin/", function(){
  $View = new \View\View("后台管理 &middot; 选课指南", "2", "1");
  $MoudleAdmin = new \Moudle\MoudleAdmin();
  $View->setData($MoudleAdmin->getData("admin_home"));
  $View->show("admin_home");
});
$router->get("/admin/a", function(){
  echo "Admin~ a : )";
});
$router->get("/a", function(){
  echo "a : )";
  $UD = new \User\UserDAO();
  $U = $UD->getObjectByID("11110206");
  print_r(array_values($U->get("selected_list")));
});
$router->get("/", function(){
  $View = new \View\View("所有课程 &middot; 选课指南", "0", "1");
  $MoudleUser = new \Moudle\MoudleUser();
  $View->setData($MoudleUser->getData("home"));
  $View->show("home");
});