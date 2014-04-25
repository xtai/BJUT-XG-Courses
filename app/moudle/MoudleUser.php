<?php
/**
*
* Class MoudleUser
*
* Moudle for all User's event
*
* author: Xiaoyu Tai @ Beijing, 2014.4.25
*
*/

namespace Moudle;

class MoudleUser extends Moudle{

  public function __construct(){
    return null;
  }

  public function login($username, $password){
    $password = self::md5_password($password);
  	$UserDAO = new \User\UserDAO();
  	$User = $UserDAO->login($username, $password);
    if($User != null){
      $User->set("user_lastlogin", date('Y-m-d H:i:s'));
      $User->set("user_logintimes", $User->get("user_logintimes")+1);
      $UserDAO->updateObject($User);
      $_SESSION['xg_user_type'] = "users";
      $data = $User->getAll();
      foreach ($data as $key => $value) {
        $_SESSION["xg_".$key] = $value;
      }
      return 1;
    }else{
      $_SESSION['xg_wrong_password'] = true;
      return 0;
    }
  }

  // public function getData($viewname){
  //   $data       = array();
  //   $UserDAO    = new \User\UserDAO();
  //   $MajorDAO   = new \Major\MajorDAO();
  //   $SubjectDAO = new \Subject\SubjectDAO();
  //   switch($viewname){
  //     case "home":
  //       $data["basic"]["user"]    = $UserDAO->totalNum("user");
  //       $data["basic"]["class"]   = $UserDAO->totalNum("class");
  //       $data["basic"]["major"]   = $MajorDAO->totalNum("major");
  //       $data["basic"]["subject"] = $SubjectDAO->totalNum("subject");
  //       $data["basic"]["select"]  = $SubjectDAO->totalNum("select");
  //       $data["lastlogin"]        = $UserDAO->lastLogin(6);
  //       break;
  //     default:
  //       break;
  //   }
  //   return $data;
  // }
}
