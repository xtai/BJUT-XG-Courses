<?php
/**
*
* Class MajorDAO -> DB table majors + major_plans
*
* Data Access Object
*
* author: Xiaoyu Tai @ Beijing, 2014.4.24
*
*/

namespace Major;

use Base\DAO;

class MajorDAO extends \Base\DAO{

  public function __construct(){
    return null;
  }

  public function getObjectByID($major_id){
  	$Major = new Major();
  	$result = \Base\MySQL::query("SELECT * FROM majors WHERE major_id = '". $major_id ."';");
    if(mysql_num_rows($result) == 1){
      $result = mysql_fetch_array($result, MYSQL_ASSOC);
      foreach ($result as $key => $value) {
        $Major->set($key, $value);
      }
      return $Major;
    }else{
      trigger_error("Major(".$major_id.") doesn't exists in Database!");
      return 0;
    }
  }

  public function insertObject($Major){
    $data = $Major->getAll();
    $result = \Base\MySQL::query("SELECT * FROM majors WHERE major_id = '". $data["major_id"] ."';");
    if(mysql_num_rows($result) == 0){
      \Base\MySQL::query("INSERT INTO `majors` (`major_id`, `major_name`, `major_startyear`, `major_endyear`) VALUES ('".$data["major_id"]."', '".$data["major_name"]."', '".$data["major_startyear"]."', '".$data["major_endyear"]."');");
      return 1;
    }else{
      trigger_error("Major(".$data["major_id"].") already exsisted in Database!");
    }
    return 0;
  }

  // update() is based on major_id(PK)
  public function updateObject($Major){
    $data = $Major->getAll();
    $result = \Base\MySQL::query("SELECT * FROM majors WHERE major_id = '". $data["major_id"] ."';");
    if(mysql_num_rows($result) == 1){
      \Base\MySQL::query("UPDATE `majors` SET `major_name`='".$data["major_name"]."', `major_startyear`='".$data["major_startyear"]."', `major_endyear`='".$data["major_endyear"]."' WHERE `major_id`='".$data["major_id"]."';");
      return 1;
    }else{
      trigger_error("Major(".$data["major_id"].") doesn't exists in Database!");
    }
    return 0;
  }

  public function deleteObject($Major){
    $data = $Major->getAll();
    $result = \Base\MySQL::query("SELECT * FROM majors WHERE major_id = '". $data["major_id"] ."';");
    if(mysql_num_rows($result) == 1){
      \Base\MySQL::query("DELETE FROM `majors` WHERE `major_id`='".$data["major_id"]."';");
      return 1;
    }else{
      trigger_error("Major(".$data["major_id"].") doesn't exists in Database!");
    }
    return 0;
  }

  public function deleteObjectByID($major_id){
    $result = \Base\MySQL::query("SELECT * FROM majors WHERE major_id = '". $major_id ."';");
    if(mysql_num_rows($result) == 1){
      \Base\MySQL::query("DELETE FROM `majors` WHERE `major_id`='".$major_id."';");
      return 1;
    }else{
      trigger_error("Major(".$major_id.") doesn't exists in Database!");
    }
    return 0;
  }

  public function totalNum($variable){
    switch ($variable) {
      case 'major':
        $result = \Base\MySQL::query("SELECT DISTINCT major_id FROM majors;");
        return mysql_num_rows($result);
      default:
        return null;
    }
  }

}
