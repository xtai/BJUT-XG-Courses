<?php
/**
* Class UserDAO -> DB table users + user_subject + admins
* Data Access Object
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.25
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*/

namespace User;

class UserDAO extends \Base\DAO{

  public function __construct(){
    return null;
  }

  public function getObjectByID($user_id){
    $User = new User();
    $result = \Base\MySQL::query("SELECT * FROM users WHERE user_id = '". $user_id ."';");
    if(mysql_num_rows($result)){
      $result = mysql_fetch_array($result, MYSQL_ASSOC);
      foreach ($result as $key => $value) {
        $User->set($key, $value);
      }
      $result = \Base\MySQL::query("SELECT * FROM `user_subject` WHERE `user_id` = '". $user_id ."';");
      if(mysql_num_rows($result)){
        $data = array();
        $i = 0;
        while($data[$i] = mysql_fetch_array($result, MYSQL_ASSOC)){
          $i++;
        }
        $User->set("selected_list", $data);
      }
      return $User;
    }else{
      trigger_error("User(".$user_id.") doesn't exists in Database!");
      return 0;
    }
  }

  public function insertObject($User){
    $data = $User->getAll();
    if(!$this->checkUser($data["user_id"])){
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
      if($data["user_logintimes"] == ""){
        $user_logintimes = 0;
      }else{
        $user_logintimes = "'". $data["user_logintimes"] ."'";
      }
      \Base\MySQL::query("INSERT INTO `users` (`user_id`, `major_id`, `class_id`, `user_password`, `user_name`, `user_lastlogin`, `user_logintimes`, `user_lastpwdchange`) VALUES ('".$data["user_id"]."', '".$data["major_id"]."', '".$data["class_id"]."', '".$data["user_password"]."', '".$data["user_name"]."', ".$user_lastlogin.", ".$user_logintimes.", ".$user_lastpwdchange.");");
      return 1;
    }else{
      trigger_error("User(".$data["user_id"].") already exsisted in Database!");
    }
    return 0;
  }

  public function updateObject($User){
    $data = $User->getAll();
    if($this->checkUser($data["user_id"])){
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
      \Base\MySQL::query("UPDATE `users` SET `major_id`='".$data["major_id"]."', `class_id`='".$data["class_id"]."', `user_password`='".$data["user_password"]."', `user_name`='".$data["user_name"]."', `user_logintimes`='".$data["user_logintimes"]."',`user_lastlogin`=".$user_lastlogin.", `user_lastpwdchange`=".$user_lastpwdchange."   WHERE `user_id`='".$data["user_id"]."';");
      return 1;
    }else{
      trigger_error("User(".$data["user_id"].") doesn't exists in Database!");
    }
    return 0;
  }

  public function deleteObject($User){
    $data = $User->getAll();
    if($this->checkUser($data["user_id"])){
      \Base\MySQL::query("DELETE FROM `users` WHERE `user_id`='".$data["user_id"]."';");
      return 1;
    }else{
      trigger_error("User(".$data["user_id"].") doesn't exists in Database!");
    }
    return 0;
  }

  public function deleteObjectByID($user_id){
    if($this->checkUser($user_id)){
      \Base\MySQL::query("DELETE FROM `users` WHERE `user_id`='".$user_id."';");
      return 1;
    }else{
      trigger_error("User(".$user_id.") doesn't exists in Database!");
    }
    return 0;
  }
  public function login($user_id, $user_password){
    $User = new User();
    $result = \Base\MySQL::query("SELECT * FROM users WHERE user_id = '". $user_id ."' AND user_password = '". $user_password ."';");
    if(mysql_num_rows($result) == 1){
      $User = $this->getObjectByID($user_id);
      return $User;
    }else{
      return null;
    }
  }
  public function totalNum($variable){
    switch ($variable) {
      case 'user':
        $result = \Base\MySQL::query("SELECT DISTINCT user_id FROM users;");
        return mysql_num_rows($result);
      case 'class':
        $result = \Base\MySQL::query("SELECT DISTINCT class_id FROM users;");
        return mysql_num_rows($result);
      default:
        return null;
    }
  }
  public function lastLogin($limit){
    $data = array();
    $i = 0;
    $User = new User();
    $result = \Base\MySQL::query("SELECT user_id, user_name, user_lastlogin FROM users ORDER BY user_lastlogin DESC LIMIT ".$limit.";");
    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
      $data[$i]["user_id"] = $row["user_id"];
      $data[$i]["user_name"] = $row["user_name"];
      $data[$i]["user_lastlogin"] = $row["user_lastlogin"];
      $i++;
    }
    return $data;
  }
  public function newPassword($user_id, $new_password){
    $datetime = date('Y-m-d H:i:s');
    \Base\MySQL::query("UPDATE users SET user_password = '".$new_password."', user_lastpwdchange = '".$datetime."' WHERE user_id = '".$user_id."';");
    return 1;
  }
  public function getPointsByObject($User){
    $user_id = $User->get("user_id");
    $data = $this->getPointsByID($user_id);
    $User->set("got_points", $data);
    return $data;
  }
  public function getPointsByID($user_id){
    $result = \Base\MySQL::query("SELECT * FROM users_detail WHERE user_id = '". $user_id ."';");
    if(mysql_num_rows($result) == 1){
      $data = mysql_fetch_array($result, MYSQL_ASSOC);
      return $data;
    }else{
      $data = array("user_id" => $user_id,
            "point_type0" => 0,"point_type1" => 0,"point_type2" => 0,
            "point_type3" => 0,"point_type4" => 0,"point_type5" => 0,
            "point_type6" => 0,"point_type7" => 0,"point_type8" => 0);
      return $data;
    }
  }
  public function getSubjectsByUserID($user_id){
    $data = array();
    $i = 0;
    $string = "SELECT `selects_detail`.`user_id` AS `user_id`,`subjects_detail`.* "
            . "FROM selects_detail RIGHT JOIN subjects_detail ON "
            . "(`selects_detail`.`subject_id` = `subjects_detail`.`subject_id` AND "
            . "`user_id` = '". $user_id ."');";
    $result = \Base\MySQL::query($string);
    while($data[$i] = mysql_fetch_array($result, MYSQL_ASSOC)){
      $i++;
    }
    return $data;
  }
  public function getSelectedSubjectsByUserID($user_id){
    $data = array();
    $i = 0;
    $result = \Base\MySQL::query("SELECT * FROM selects_detail WHERE `user_id` = '". $user_id ."';");
    while($data[$i] = mysql_fetch_array($result, MYSQL_ASSOC)){
      $i++;
    }
    return $data;
  }
  public function checkUser($user_id){
    $result = \Base\MySQL::query("SELECT * FROM users WHERE user_id = '". $user_id ."';");
    return mysql_num_rows($result);
  }
  public function getUsersByPage($start, $num){
    $data = array();
    $i = 0;
    $result = \Base\MySQL::query("SELECT * FROM `users` LIMIT ".$start.",".$num.";");
    while($data[$i] = mysql_fetch_array($result, MYSQL_ASSOC)){
      $i++;
    }
    unset($data[$i--]);
    return $data;
  }
}
