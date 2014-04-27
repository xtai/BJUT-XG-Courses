<?php
/**
* Class MoudleAdmin
* Moudle for all Admin's event
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.25
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*/

namespace Moudle;

class MoudleAdmin extends Moudle{
  protected $num = 16; //items per page.
  public function __construct(){
    return null;
  }

  public function login($user_id, $user_password){
    $user_password = self::md5Password($user_password);
    $AdminDAO = new \User\AdminDAO();
    $Admin = $AdminDAO->login($user_id, $user_password);
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
  public function newPassword($new_password){
    $new_password = self::md5Password($new_password);
    $AdminDAO = new \User\AdminDAO();
    return $AdminDAO->newPassword($_SESSION["xg_user_id"], $new_password);;
  }
  public function getSubjectData($subject_id){
    $SubjectDAO = new \Subject\SubjectDAO();
    $data       = array();
    if($SubjectDAO->checkSubject($subject_id)){
      $MajorDAO = new \Major\MajorDAO();
      //$data["class_list"]  = $MajorDAO->getObjectByID($_SESSION["xg_major_id"])->get("class_list");
      $data["subject"]     = $SubjectDAO->getObjectByID($subject_id)->getAll();
      $data["enroll_user"] = $SubjectDAO->getEnrollListByID($subject_id);
      $data["viewname"]    = "admin_subject_single";
      return $data;
    }else{
      $data["subject"]["subject_id"]   = $subject_id;
      $data["subject"]["subject_name"] = "课程不存在";
      $data["viewname"]                = "admin_subject_non";
      return $data;
    }
  }
  public function getUserData($user_id){
    $UserDAO = new \User\UserDAO();
    $data    = array();
    if($UserDAO->checkUser($user_id)){
      $MajorDAO   = new \Major\MajorDAO();
      $User       = $UserDAO->getObjectByID($user_id);
      $data["subject_list"] = $UserDAO->getSelectedSubjectsByUserID($user_id);
      $data["got_points"]   = $UserDAO->getPointsByID($user_id);
      $data["major_plans"]  = $MajorDAO->getObjectByID($User->get("major_id"))->get("major_plans");
      $data["user"]         = $User->getAll();
      $data["_title"]       = $User->get("user_name") . " 的选课";
      $data["viewname"]     = "admin_user_single";
      return $data;
    }else{
      $data["user"]["user_id"] = $user_id;
      $data["_title"]          = "用户不存在";
      $data["viewname"]        = "admin_user_non";
      return $data;
    }
  }
  public function getTotalPageNum($viewname){
    $this->num = 16; //20 items per page.
    switch($viewname){
      case "subject":
        $SubjectDAO = new \Subject\SubjectDAO();
        return ceil($SubjectDAO->totalNum("subject")/$this->num);
      case "user":
        $UserDAO = new \User\UserDAO();
        return ceil($UserDAO->totalNum("user")/$this->num);
      default:
        return 0;
    }
  }
  public function getSubjectMainData($page_current_num){
    $data = array();
    $SubjectDAO = new \Subject\SubjectDAO();
    $item_total_num = $SubjectDAO->totalNum("subject");
    $data["page"] = $this->getPageData($page_current_num, $item_total_num, $this->num);
    $start = ($page_current_num - 1)*$this->num;
    $data["subject"] = $SubjectDAO->getSubjectsByPage($start, $this->num);
    return $data;
  }
  public function getUserMainData($page_current_num){
    $data = array();
    $UserDAO = new \User\UserDAO();
    $item_total_num = $UserDAO->totalNum("user");
    $data["page"] = $this->getPageData($page_current_num, $item_total_num, $this->num);
    $start = ($page_current_num - 1)*$this->num;
    $data["user"] = $UserDAO->getUsersByPage($start, $this->num);
    return $data;
  }
  public function getData($viewname){
    $data = array();
    switch($viewname){
      case "admin_home":
        $UserDAO    = new \User\UserDAO();
        $AdminDAO   = new \User\AdminDAO();
        $MajorDAO   = new \Major\MajorDAO();
        $SubjectDAO = new \Subject\SubjectDAO();
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
  private function getPageData($page_current_num, $item_total_num, $num_per_page){
    $data = array();
    $data["item_total_num"]   = $item_total_num;
    $data["page_total_num"]   = ceil($item_total_num/$num_per_page);
    $data["page_current_num"] = $page_current_num;
    $data["first_page"]       = 0;
    $data["last_page"]        = 0;
    $data["num_per_page"]     = $num_per_page;
    if($page_current_num==1){
      $data["first_page"] = 1;
    }elseif($page_current_num==$data["page_total_num"]){
      $data["last_page"] = 1;
    }
    return $data;
  }
}
