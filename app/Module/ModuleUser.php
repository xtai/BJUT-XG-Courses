<?php
/**
* Class ModuleUser
* Module for all User's event
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.26
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*/

namespace Module;

class ModuleUser extends Module{

  public function __construct(){
    return null;
  }

  public function login($user_id, $user_password){
    $user_password = self::md5Password($user_password);
  	$UserDAO = new \User\UserDAO();
  	$User = $UserDAO->login($user_id, $user_password);
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
  public function newPassword($new_password){
    $new_password = self::md5Password($new_password);
    $UserDAO = new \User\UserDAO();
    return $UserDAO->newPassword($_SESSION["xg_user_id"], $new_password);;
  }
  public function ajax_change($subject_id, $option){
    $SubjectDAO = new \Subject\SubjectDAO();
    if($option == 'insert'){
      echo $SubjectDAO->selectSubject($_SESSION["xg_user_id"], $subject_id);
    }elseif($option == 'delete'){
      echo !$SubjectDAO->unSelectSubject($_SESSION["xg_user_id"], $subject_id);
    }
  }
  public function getSubjectData($subject_id){
    $SubjectDAO = new \Subject\SubjectDAO();
    $data       = array();
    if($SubjectDAO->checkSubject($subject_id)){
      $MajorDAO = new \Major\MajorDAO();
      $data["class_list"]  = $MajorDAO->getObjectByID($_SESSION["xg_major_id"])->get("class_list");
      $data["subject"]     = $SubjectDAO->getObjectByID($subject_id)->getAll();
      $data["enroll_user"] = $SubjectDAO->getEnrollListByID($subject_id);
      $data["viewname"]    = "subject";
      return $data;
    }else{
      $data["subject"]["subject_id"]   = $subject_id;
      $data["subject"]["subject_name"] = "课程不存在";
      $data["viewname"]                = "subject_non";
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
      $data["viewname"]     = "user";
      return $data;
    }else{
      $data["user"]["user_id"] = $user_id;
      $data["_title"]          = "用户不存在";
      $data["viewname"]        = "user_non";
      return $data;
    }
  }
  public function getData($viewname){
    $data = array();
    switch($viewname){
      case "home":
        $UserDAO    = new \User\UserDAO();
        $MajorDAO   = new \Major\MajorDAO();
        $SubjectDAO = new \Subject\SubjectDAO();
        $data["subject_list"] = $UserDAO->getSubjectsByUserID($_SESSION["xg_user_id"]);
        $data["got_points"]   = $UserDAO->getPointsByID($_SESSION["xg_user_id"]);
        $data["major_plans"]  = $MajorDAO->getObjectByID($_SESSION["xg_major_id"])->get("major_plans");
        break;
      case "mine":
        $UserDAO    = new \User\UserDAO();
        $MajorDAO   = new \Major\MajorDAO();
        $SubjectDAO = new \Subject\SubjectDAO();
        $data["subject_list"] = $UserDAO->getSelectedSubjectsByUserID($_SESSION["xg_user_id"]);
        $data["got_points"]   = $UserDAO->getPointsByID($_SESSION["xg_user_id"]);
        $data["major_plans"]  = $MajorDAO->getObjectByID($_SESSION["xg_major_id"])->get("major_plans");
        break;
      case "plan":
        $MajorDAO = new \Major\MajorDAO();
        $data["plan_link"] = $MajorDAO->getObjectByID($_SESSION["xg_major_id"])->get("plan_link");
        break;
      default:
        break;
    }
    return $data;
  }
}
