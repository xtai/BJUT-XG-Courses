<?php
/**
*
* Class MoudleAdmin
*
* Moudle for all Admin's event
*
* author: Xiaoyu Tai @ Beijing, 2014.4.25
*
*/

namespace Moudle;

class MoudleAdmin extends Moudle{

  public function __construct(){
    return null;
  }

  public function login($username, $password){
    $password = self::md5_password($password);
    $AdminDAO = new \User\AdminDAO();
    $Admin = $AdminDAO->login($username, $password);
    if($Admin != null){
      $Admin->set("user_lastlogin", date('Y-m-d H:i:s'));
      $Admin->set("user_logintimes", $Admin->get("user_logintimes")+1);
      $AdminDAO->updateObject($Admin);
      $_SESSION['xg_user_type'] = "admins";
      $data = $Admin->getAll();
      foreach ($data as $key => $value) {
        $_SESSION["xg_".$key] = $value;
      }
      return 1;
    }else{
      $_SESSION['xg_wrong_password'] = true;
      return 0;
    }
  }

  public function getData($viewname){
    $data       = array();
    $UserDAO    = new \User\UserDAO();
    $AdminDAO   = new \User\AdminDAO();
    $MajorDAO   = new \Major\MajorDAO();
    $SubjectDAO = new \Subject\SubjectDAO();
    switch($viewname){
      case "admin_home":
        $data["basic"]["user"]    = $UserDAO->totalNum("user");
        $data["basic"]["class"]   = $UserDAO->totalNum("class");
        $data["basic"]["admin"]   = $AdminDAO->totalNum("admin");
        $data["basic"]["major"]   = $MajorDAO->totalNum("major");
        $data["basic"]["subject"] = $SubjectDAO->totalNum("subject");
        $data["basic"]["select"]  = $SubjectDAO->totalNum("select");
        $data["lastlogin"]        = $UserDAO->lastLogin(6);
        break;
      default:
        break;
    }
    return $data;
  }
}
