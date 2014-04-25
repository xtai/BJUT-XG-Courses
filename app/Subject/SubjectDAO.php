<?php
/**
*
* Class SubjectDAO -> DB table subjects + user_subject
*
* Data Access Object
*
* author: Xiaoyu Tai @ Beijing, 2014.4.25
*
*/

namespace Subject;

use Base\DAO;

class SubjectDAO extends \Base\DAO{

  public function __construct(){
    return null;
  }

  public function getObjectByID($subject_id){
    $Subject = new Subject();
    $result = \Base\MySQL::query("SELECT * FROM subjects_detail WHERE subject_id = '". $subject_id ."';");
    if(mysql_num_rows($result) == 1){
      $result = mysql_fetch_array($result, MYSQL_ASSOC);
      foreach ($result as $key => $value) {
        $Subject->set($key, $value);
      }
      return $Subject;
    }else{
      trigger_error("Subject(".$subject_id.") doesn't exists in Database!");
      return 0;
    }
  }

  public function insertObject($Subject){
    $data = $Subject->getAll();
    $result = \Base\MySQL::query("SELECT * FROM subjects WHERE subject_id = '". $data["subject_id"] ."';");
    if(mysql_num_rows($result) == 0){
    \Base\MySQL::query("INSERT INTO `subjects` (`subject_id`, `subject_name`, `subject_examtype`, `subject_point`, `subject_type`, `subject_time`, `subject_school`, `major_id`) VALUES ('".$data["subject_id"]."', '".$data["subject_name"]."', '".$data["subject_examtype"]."', '".$data["subject_point"]."', '".$data["subject_type"]."', '".$data["subject_time"]."', '".$data["subject_school"]."', '".$data["major_id"]."');");
      return 1;
    }else{
      trigger_error("Subject(".$data["subject_id"].") already exsisted in Database!");
    }
    return 0;
  }

  public function updateObject($Subject){
    $data = $Subject->getAll();
    $result = \Base\MySQL::query("SELECT * FROM subjects WHERE subject_id = '". $data["subject_id"] ."';");
    if(mysql_num_rows($result) == 1){
      \Base\MySQL::query("UPDATE `subjects` SET `subject_name`='".$data["subject_name"]."', `subject_examtype`='".$data["subject_examtype"]."', `subject_point`='".$data["subject_point"]."', `subject_type`='".$data["subject_type"]."', `subject_time`='".$data["subject_time"]."', `subject_school`='".$data["subject_school"]."', `major_id`='".$data["major_id"]."' WHERE `subject_id`='".$data["subject_id"]."';");
      return 1;
    }else{
      trigger_error("Subject(".$data["subject_id"].") doesn't exists in Database!");
    }
    return 0;
  }

  public function deleteObject($Subject){
    $data = $Subject->getAll();
    $result = \Base\MySQL::query("SELECT * FROM subjects WHERE subject_id = '". $data["subject_id"] ."';");
    if(mysql_num_rows($result) == 1){
      \Base\MySQL::query("DELETE FROM `subjects` WHERE `subject_id`='".$data["subject_id"]."';");
      return 1;
    }else{
      trigger_error("Subject(".$data["subject_id"].") doesn't exists in Database!");
    }
    return 0;
  }

  public function deleteObjectByID($subject_id){
    $result = \Base\MySQL::query("SELECT * FROM subjects WHERE subject_id = '". $subject_id ."';");
    if(mysql_num_rows($result) == 1){
      \Base\MySQL::query("DELETE FROM `subjects` WHERE `subject_id`='".$subject_id."';");
      return 1;
    }else{
      trigger_error("Subject(".$subject_id.") doesn't exists in Database!");
    }
    return 0;
  }

  public function totalNum($variable){
    switch($variable){
      case 'subject':
        $result = \Base\MySQL::query("SELECT DISTINCT subject_id FROM subjects;");
        return mysql_num_rows($result);
      case 'select':
        $result = \Base\MySQL::query("SELECT * FROM user_subject;");
        return mysql_num_rows($result);
      default:
        return null;
    }
  }
}
