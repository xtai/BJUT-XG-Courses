<?php
/**
* Route filtration rule
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.25
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*
* Thanks Van Damme(@Bramus) for this amazing PHP Router
* <https://github.com/bramus/router>
*/
/**
* === Before Routing =================================================
* set authorization for regular users and admins.
*   Logic is here:
*     Everyone:    only [/mit/, /login/, /admin/login/]
*     Auth Uesrs:  [/.*], not include [/admin/.*, /lgoin/]
*     Auth Admins: only [/admin/.*], not include [/admin/login/]
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