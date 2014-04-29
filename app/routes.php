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
/**
* === 404 Pages ======================================================
* And it looks like this: 
*   404 Not Found
*        :(
* ====================================================================
*/
$router->set404(function() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  echo "<html><head><meta charset=\"utf-8\"><meta name=\"viewport\" content=\"w"
     . "idth=device-width, initial-scale=1.0\"><title>404 Not Found</title></he"
     . "ad><body><center style=\"margin-top: 60px; font-size:30px; color:#999; "
     . "font-weight:100;\">404 Not Found</center><center style=\"margin-top: 20"
     . "px; font-size:100px; color:#333; font-weight:100;\">: (</center></body>";
});
/**
* === For Everyone without Auth ======================================
* [/mit/, /login/, /admin/login/]
*   GET  - /mit/         MIT License
*   GET  - /login/       User Login
*   GET  - /admin/login/ Admin Login
*   POST - /login/       POST Method for User Login
*   POST - /admin/login/ POST Method for Admin Login
*
* Notes: 
*   To switch /login/ <==> /admin/login:
*   press ":" key when you are in login pages.                    : )
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
  $ModelUser = new \Model\ModelUser();
  $ModelUser->login($_POST["username"], $_POST["password"]);
  header("location: /");
});
$router->get("/admin/login", function(){
  $View = new \View\View("后台登陆", "3", null);
  $View->show("admin_login");
});
$router->post("/admin/login", function(){
  $ModelAdmin = new \Model\ModelAdmin();
  $ModelAdmin->login($_POST["username"], $_POST["password"]);
  header("location: /admin/");
});
/**
* === For Auth Users =================================================
* [/.*], not include [/admin/.*, /lgoin/]
*   GET  - /             Home Page - 所有课程
*   POST - /select/      AJAX - select/unselect
*   GET  - /mine/        Mine Page - 我的课程
*   GET  - /logout/      Logout --> unAuth
*   GET  - /plan/        Plan - 教学计划
*   GET  - /message/     Message - 留言板
*   GET  - /password/    Password - 修改密码
*   POST - /password/    POST Method for Change Password
*   GET  - /subject/\d*  Subject info
*   GET  - /user/\w*     User info
*   GET  - /user/?q=\w*  Search User info
* ====================================================================
*/
$router->get("/", function(){
  $ModelUser = new \Model\ModelUser();
  $View = new \View\View("所有课程 &middot; 选课指南", "0", "1");
  $View->setData($ModelUser->getData("home"));
  $View->show("home");
});
$router->post("/select", function(){
  $ModelUser = new \Model\ModelUser();
  $ModelUser->ajax_change($_POST['sid'], $_POST['option']);
});
$router->get("/mine", function(){
  $ModelUser = new \Model\ModelUser();
  $View = new \View\View("我的课程 &middot; 选课指南", "0", "2");
  $View->setData($ModelUser->getData("mine"));
  $View->show("mine");
});
$router->get("/logout", function(){
  $ModelUser = new \Model\ModelUser();
  $ModelUser::logout();
  header("location: /login/");
});
$router->get("/plan", function(){
  $ModelUser = new \Model\ModelUser();
  $View = new \View\View("教学计划 &middot; 选课指南", "0", "3");
  $View->setData($ModelUser->getData("plan"));
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
  $ModelUser = new \Model\ModelUser();
  $ModelUser->newPassword($_POST["password"]);
  header("location: /logout/");
});
$router->get('/subject/(\d*)', function($subject_id){
  $ModelUser = new \Model\ModelUser();
  $data = $ModelUser->getSubjectData($subject_id);
  $View = new \View\View($data["subject"]["subject_name"]." &middot; 选课指南", "0", null);
  $View->setData($data);
  $View->show($data["viewname"]);
});
$router->get('/user/(\w*)', function($user_id){
  $ModelUser = new \Model\ModelUser();
  $data = $ModelUser->getUserData($user_id);
  $View = new \View\View($data["_title"]." &middot; 选课指南", "0", null);
  $View->setData($data);
  $View->show($data["viewname"]);
});
$router->get('/user/', function(){
  if(isset($_GET["q"]) && preg_match("/\w*/", $_GET["q"])){
    header("location: /user/".$_GET["q"]);
  }else{
    header("location: /mine/");
  }
});
/**
* === For Auth Admins ================================================
* [/admin/.*]
*   GET  - /admin/                 Admin Page - 后台管理
*   GET  - /admin/logout/          Logout --> unAuth
*   GET  - /admin/password/        Password - 修改密码
*   POST - /admin/password/        POST Method for Change Password
*   GET  - /admin/user/            User - 学生管理
*   POST - /admin/user/new         User - 添加学生
*   POST - /admin/user/import      User - 导入班级
*   GET  - /admin/user/?q=.*       User Search
*   GET  - /admin/user/\w*         User Info
*   GET  - /admin/subject/         Subject - 课程管理
*   POST - /admin/subject/new      Subject - 添加课程
*   POST - /admin/subject/import   Subject - 导入课程
*   GET  - /admin/user/?q=.*       Subject Search
*   GET  - /admin/subject/\d*      Subject Info
*   GET  - /admin/major/           Major - 教学计划管理
*   POST - /admin/major/new        Major - 新建教学计划
*   POST - /admin/major/import     Major - 导入教学计划
*   GET  - /admin/major/\d*        Major Info
*   GET  - /admin/import/          Import - 导入向导
* ====================================================================
*/
$router->get("/admin/logout", function(){
  $ModelAdmin = new \Model\ModelAdmin();
  $ModelAdmin::logout();
  header("location: /admin/login/");
});
$router->get("/admin/", function(){
  $View = new \View\View("面板 &middot; 选课指南后台管理", "2", "1");
  $ModelAdmin = new \Model\ModelAdmin();
  $View->setData($ModelAdmin->getData("admin_home"));
  $View->show("admin_home");
});
$router->get("/admin/password", function(){
  $View = new \View\View("修改密码 &middot; 选课指南后台管理", "2", "6");
  $View->show("admin_password");
});
$router->post("/admin/password", function(){
  $ModelAdmin = new \Model\ModelAdmin();
  $ModelAdmin->newPassword($_POST["password"]);
  header("location: /admin/logout/");
});
$router->get("/admin/user", function(){
  if(isset($_GET["q"]) && preg_match("/\w*/", $_GET["q"])){
    header("location: /admin/user/".$_GET["q"]);
  }else{
    $ModelAdmin = new \Model\ModelAdmin();
    $total_page_num = $ModelAdmin->getTotalPageNum("user");
    $page_current_num = 1;
    if(isset($_GET["p"])){
      if(preg_match("/\d*/", $_GET["p"]) && ($_GET["p"] > 0) && (($total_page_num - $_GET["p"]) >= 0)){
        $page_current_num = $_GET["p"];
      }
    }
    $data = $ModelAdmin->getUserMainData($page_current_num);
    $View = new \View\View("用户管理 &middot; 选课指南后台管理", "2", "2");
    $View->setData($data);
    $View->show("admin_user");
  }
});
$router->post("/admin/user/new", function(){
  
  // get input data
  $data = $_POST;
  var_dump($data);

  // create new user

  // redirect to /admin/user and show success

  // or fail

});
$router->post("/admin/user/import", function(){

  // get input data
  $data = $_POST;
  var_dump($data);

  // import class info

  // redirect to /admin/user and show success

  // or fail

  // test route
  echo "import class";
});
$router->get('/admin/user/(\d*)', function($user_id){
  $ModelAdmin = new \Model\ModelAdmin();
  $data = $ModelAdmin->getUserData($user_id);
  $View = new \View\View($data["_title"]." &middot; 选课指南后台管理", "0", null);
  $View->setData($data);
  $View->show($data["viewname"]);
});
$router->get("/admin/subject", function(){
  if(isset($_GET["q"]) && preg_match("/\d*/", $_GET["q"])){
    header("location: /admin/subject/".$_GET["q"]);
  }else{
    $ModelAdmin = new \Model\ModelAdmin();
    $total_page_num = $ModelAdmin->getTotalPageNum("subject");
    $page_current_num = 1;
    if(isset($_GET["p"])){
      if(preg_match("/\d*/", $_GET["p"]) && ($_GET["p"] > 0) && (($total_page_num - $_GET["p"]) >= 0)){
        $page_current_num = $_GET["p"];
      }
    }
    $data = $ModelAdmin->getSubjectMainData($page_current_num);
    $View = new \View\View("课程管理 &middot; 选课指南后台管理", "2", "3");
    $View->setData($data);
    $View->show("admin_subject");
  }
});
$router->post("/admin/subject/new", function()
{
  // get input data
  $data = $_POST;
  var_dump($data);

  // import class info

  // redirect to /admin/subject and show success

  // or return fail

  // test
  echo "new subject";
});
$router->post("/admin/subject/import", function()
{
  // get input data
  $data = $_POST;
  var_dump($data);

  // import class info

  // redirect to /admin/subject and show success

  // or fail

  // test
  echo "import subjects";
});
$router->get('/admin/subject/(\d*)', function($subject_id){
  $ModelAdmin = new \Model\ModelAdmin();
  $data = $ModelAdmin->getSubjectData($subject_id);
  $View = new \View\View($data["subject"]["subject_name"]." &middot; 选课指南后台管理", "0", null);
  $View->setData($data);
  $View->show($data["viewname"]);
});
$router->get("/admin/major", function(){
  $View = new \View\View("教学计划管理 &middot; 选课指南后台管理", "2", "4");
  $View->show("admin_major");
});
$router->post("/admin/major/new", function()
{
  // get input data
  $data = $_POST;
  var_dump($data);

  // import class info

  // redirect to /admin/subject and show success

  // or return fail

  // test
  echo "new major";
});
$router->post("/admin/major/import", function()
{
  // get input data
  $data = $_POST;
  var_dump($data);

  // import class info

  // redirect to /admin/subject and show success

  // or fail

  // test
  echo "import majors";
});

$router->get("/admin/import", function(){
  $View = new \View\View("导入向导 &middot; 选课指南后台管理", "2", "5");
  $View->show("admin_import");
});

/**
* ====================================================================
* Testing routes
* ====================================================================
*/
/*
$router->get("/admin/a", function(){
  echo "admin/a : )<br/>";
});
$router->get("/a", function(){
  echo "a : )<br/>";
});
*/