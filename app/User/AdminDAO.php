<?php
/**
* Class AdminDAO -> DB table admins
* Data Access Object
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.25
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*/

namespace User;

class AdminDAO extends \Base\DAO{

  public function __construct(){
    return null;
  }

  public function getObjectByID($user_id){
    $Admin = new Admin();
    $result = \Base\MySQL::query("SELECT * FROM admins WHERE user_id = '". $user_id ."';");
    if(mysql_num_rows($result) == 1){
      $result = mysql_fetch_array($result, MYSQL_ASSOC);
      foreach ($result as $key => $value) {
        $Admin->set($key, $value);
      }
      return $Admin;
    }else{
      trigger_error("Admin(".$user_id.") doesn't exists in Database!");
      return 0;
    }
  }

  public function insertObject($Admin){
    $data = $Admin->getAll();
    $result = \Base\MySQL::query("SELECT * FROM admins WHERE user_id = '". $data["user_id"] ."';");
    if(mysql_num_rows($result) == 0){
      if($data["user_lastlogin"] == ""){
        $user_lastlogin = "NULL";
      }else{
        $user_lastlogin = "'". $data["user_lastlogin"] ."'";
      }
      if($data["user_lastpwdchange"] == ""){
        $user_lastpwdchange = "NULL";
      }else{
        $user_lastpwdchange = "'". $data["user_lastpwdchange"] ."'";
      }
      \Base\MySQL::query("INSERT INTO `admins` (`user_id`, `user_password`, `user_name`, `user_lastlogin`, `user_logintimes`, `user_lastpwdchange`) VALUES ('".$data["user_id"]."', '".$data["user_password"]."', '".$data["user_name"]."', ".$user_lastlogin.", '".$data["user_logintimes"]."', ".$user_lastpwdchange.");");
      return 1;
    }else{
      trigger_error("Admin(".$data["user_id"].") already exsisted in Database!");
    }
    return 0;
  }

  public function updateObject($Admin){
    $data = $Admin->getAll();
    $result = \Base\MySQL::query("SELECT * FROM admins WHERE user_id = '". $data["user_id"] ."';");
    if(mysql_num_rows($result) == 1){
      if($data["user_lastlogin"] == ""){
        $user_lastlogin = "NULL";
      }else{
        $user_lastlogin = "'". $data["user_lastlogin"] ."'";
      }
      if($data["user_lastpwdchange"] == ""){
        $user_lastpwdchange = "NULL";
      }else{
        $user_lastpwdchange = "'". $data["user_lastpwdchange"] ."'";
      }
      \Base\MySQL::query("UPDATE `admins` SET `user_password`='".$data["user_password"]."', `user_name`='".$data["user_name"]."', `user_logintimes`='".$data["user_logintimes"]."',`user_lastlogin`=".$user_lastlogin.", `user_lastpwdchange`=".$user_lastpwdchange."   WHERE `user_id`='".$data["user_id"]."';");
      return 1;
    }else{
      trigger_error("Admin(".$data["user_id"].") doesn't exists in Database!");
    }
    return 0;
  }

  public function deleteObject($Admin){
    $data = $Admin->getAll();
    $result = \Base\MySQL::query("SELECT * FROM admins WHERE user_id = '". $data["user_id"] ."';");
    if(mysql_num_rows($result) == 1){
      \Base\MySQL::query("DELETE FROM `admins` WHERE `user_id`='".$data["user_id"]."';");
      return 1;
    }else{
      trigger_error("Admin(".$data["user_id"].") doesn't exists in Database!");
    }
    return 0;
  }

  public function deleteObjectByID($user_id){
    $result = \Base\MySQL::query("SELECT * FROM admins WHERE user_id = '". $user_id ."';");
    if(mysql_num_rows($result) == 1){
      \Base\MySQL::query("DELETE FROM `admins` WHERE `user_id`='".$user_id."';");
      return 1;
    }else{
      trigger_error("Admin(".$user_id.") doesn't exists in Database!");
    }
    return 0;
  }
  public function login($user_id, $user_password){
    $Admin = new Admin();
    $result = \Base\MySQL::query("SELECT * FROM admins WHERE user_id = '". $user_id ."' AND user_password = '". $user_password ."';");
    if(mysql_num_rows($result) == 1){
      $Admin = $this->getObjectByID($user_id);
      return $Admin;
    }else{
      return null;
    }
  }
  public function totalNum($variable){
    switch ($variable) {
      case 'admin':
        $result = \Base\MySQL::query("SELECT DISTINCT user_id FROM admins;");
        return mysql_num_rows($result);
      default:
        return null;
    }
  }
  public function newPassword($user_id, $new_password){
    $datetime = date('Y-m-d H:i:s');
    \Base\MySQL::query("UPDATE admins SET user_password = '".$new_password."', user_lastpwdchange = '".$datetime."' WHERE user_id = '".$user_id."';");
    return 1;
  }
}
