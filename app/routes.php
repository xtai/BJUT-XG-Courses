<?php
/**
* Route Maps
* Notes: needed '$router = new Router();' before and '$router->run();' after.
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.25
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*
* Thanks Van Damme(@Bramus) for this amazing PHP Router
* <https://github.com/bramus/router>
*/
// Admin/User/id
// Admin/Subject/id
// Admin/Major/id
/**
* ====404 Pages=======================================================
* And it looks like this: 
*   404 Not Found
*        :(
* ====================================================================
*/
$router->set404(function() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  echo "<html><head><meta charset=\"utf-8\"><meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"><title>404 Not Found</title></head><body><center style=\"margin-top: 60px; font-size:30px; color:#999; font-weight:100;\">404 Not Found</center><center style=\"margin-top: 20px; font-size:100px; color:#333; font-weight:100;\">: (</center></body>";
});
/**
* ====Before Routing==================================================
* set authorization for regular users and admins.
*   Logic is here:
*   Everyone:    only [/mit/, /login/, /admin/login/]
*   Auth Uesrs:  [/.*], not include [/admin/.*, /lgoin/]
*   Auth Admins: only [/admin/.*], not include [/admin/login/]
*
* Notes: need a exit(); to prevent proceing more than we need
* ====================================================================
*/
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
/**
* ====For Everyone without Auth=======================================
* [/mit/, /login/, /admin/login/]
*   GET  - /mit/         MIT License
*   GET  - /login/       User Login
*   GET  - /admin/login/ Admin Login
*   POST - /login/       POST Method for User Login
*   POST - /admin/login/ POST Method for Admin Login
* ====================================================================
*/
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
$router->get("/admin/login", function(){
  $View = new \View\View("后台登陆", "3", null);
  $View->show("admin_login");
});
$router->post("/admin/login", function(){
  $MoudleAdmin = new \Moudle\MoudleAdmin();
  $MoudleAdmin->login($_POST["username"], $_POST["password"]);
  header("location: /admin/");
});
/**
* ====For Auth Users==================================================
* [/.*], not include [/admin/.*, /lgoin/]
*   GET  - /             Home Page - 所有课程
*   POST - /select/      AJAX - select/unselect
*   GET  - /mine/        Mine Page - 我的课程
*   GET  - /logout/      Logout --> unAuth
*   GET  - /plan/        Plan - 教学计划
*   GET  - /message/     Message - 留言板
*   GET  - /password/    Password - 修改密码
*   POST - /password/    POST Method for Change Password
*   GET  - /subject/.*   Subject info
*   GET  - /user/.*      User info
* ====================================================================
*/
$router->get("/", function(){
  $MoudleUser = new \Moudle\MoudleUser();
  $View = new \View\View("所有课程 &middot; 选课指南", "0", "1");
  $View->setData($MoudleUser->getData("home"));
  $View->show("home");
});
$router->post("/select", function(){
  $MoudleUser = new \Moudle\MoudleUser();
  $MoudleUser->ajax_change($_POST['sid'], $_POST['option']);
});
$router->get("/mine", function(){
  $MoudleUser = new \Moudle\MoudleUser();
  $View = new \View\View("我的课程 &middot; 选课指南", "0", "2");
  $View->setData($MoudleUser->getData("mine"));
  $View->show("mine");
});
$router->get("/logout", function(){
  $MoudleUser = new \Moudle\MoudleUser();
  $MoudleUser::logout();
  header("location: /login/");
});
$router->get("/plan", function(){
  $MoudleUser = new \Moudle\MoudleUser();
  $View = new \View\View("教学计划 &middot; 选课指南", "0", "3");
  $View->setData($MoudleUser->getData("plan"));
  $View->show("plan");
});
$router->get("/message", function(){
  $View = new \View\View("留言板 &middot; 选课指南", "0", "4");
  $View->show("message");
});
$router->get("/password", function(){
  $View = new \View\View("修改密码 &middot; 选课指南", "0", "5");
  $View->show("password");
});
$router->post("/password", function(){
  $MoudleUser = new \Moudle\MoudleUser();
  $MoudleUser->newPassword($_POST["password"]);
  header("location: /logout/");
});
$router->get('/subject/(\d*)', function($subject_id){
  $MoudleUser = new \Moudle\MoudleUser();
  $data = $MoudleUser->getSubjectData($subject_id);
  $View = new \View\View($data["subject"]["subject_name"]." &middot; 选课指南", "0", null);
  $View->setData($data);
  $View->show($data["viewname"]);
});
$router->get('/user/(\w*)', function($user_id){
  $MoudleUser = new \Moudle\MoudleUser();
  $data = $MoudleUser->getUserData($user_id);
  $View = new \View\View($data["_title"]." &middot; 选课指南", "0", null);
  $View->setData($data);
  $View->show($data["viewname"]);
});
/**
* ====For Auth Admis==================================================
* [/admin/.*]
*   GET  - /admin/             Admin Page - 后台管理
*   GET  - /admin/logout/      Logout --> unAuth
*   GET  - /password/    Password - 修改密码
*   POST - /password/    POST Method for Change Password
* ====================================================================
*/
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
$router->get("/admin/password", function(){
  $View = new \View\View("修改密码 &middot; 选课指南", "2", "5");
  $View->show("admin_password");
});
$router->post("/admin/password", function(){
  $MoudleAdmin = new \Moudle\MoudleAdmin();
  $MoudleAdmin->newPassword($_POST["password"]);
  header("location: /admin/logout/");
});
/**
* ====================================================================
* Testing routes
* ====================================================================
*/
$router->get("/admin/a", function(){
  echo "Admin~ a : )";
});
$router->get("/a", function(){
  echo "a : )<br/>";
  $MajorDAO   = new \Major\MajorDAO();
  $UserDAO   = new \User\UserDAO();
  print_r(array_values($UserDAO->getSubjectsByUserID($_SESSION["xg_user_id"])));
});