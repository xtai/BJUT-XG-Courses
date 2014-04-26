<?php
/**
* Class MajorDAO -> DB table majors + major_plans
* Data Access Object
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.26
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*/

namespace Major;

class MajorDAO extends \Base\DAO{

  public function __construct(){
    return null;
  }

  public function getObjectByID($major_id){
  	$Major = new Major();
  	$result = \Base\MySQL::query("SELECT * FROM majors WHERE major_id = '". $major_id ."';");
    if(mysql_num_rows($result) == 1){
      $result = mysql_fetch_array($result, MYSQL_ASSOC);
      $data = array();
      foreach($result as $key => $value){
        if(preg_match("/point_.*/", $key)){
          $data[$key] = $value;
        }else{
          $Major->set($key, $value);
        }
      }
      $Major->set("major_plans", $data);
      $data = array();
      $result = \Base\MySQL::query("SELECT DISTINCT class_id FROM users WHERE major_id = '". $major_id ."';");
      $i = 0;
      while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
        $data[$i] = $row["class_id"];
        $i++;
      }
      $Major->set("class_list", $data);
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
      $string = "INSERT INTO `majors` (`major_id`, `major_name`, `major_startyear`, `major_endyear`, `plan_link`,"
              . " `point_type0`, `point_type1`, `point_type2`, `point_type3`, `point_type4`, `point_type5`,"
              . " `point_type6`, `point_type7`, `point_type8`)"
              . "VALUES ('".$data["major_id"]."', '".$data["major_name"]."', '".$data["major_startyear"]."',"
              . " '".$data["major_endyear"]."', '".$data["plan_link"]."', '".$data["major_plans"]["point_type0"]."',"
              . " '".$data["major_plans"]["point_type1"]."', '".$data["major_plans"]["point_type2"]."',"
              . " '".$data["major_plans"]["point_type3"]."', '".$data["major_plans"]["point_type4"]."',"
              . " '".$data["major_plans"]["point_type5"]."', '".$data["major_plans"]["point_type6"]."',"
              . " '".$data["major_plans"]["point_type7"]."', '".$data["major_plans"]["point_type8"]."');";
      \Base\MySQL::query($string);
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
      $string = "UPDATE `majors` SET `major_name`='".$data["major_name"]."',"
              . " `major_startyear`='".$data["major_startyear"]."',"
              . " `major_endyear`='".$data["major_endyear"]."', `plan_link`='".$data["plan_link"]."',"
              . " `point_type0`='".$data["major_plans"]["point_type0"]."',"
              . " `point_type1`='".$data["major_plans"]["point_type1"]."',"
              . " `point_type2`='".$data["major_plans"]["point_type2"]."',"
              . " `point_type3`='".$data["major_plans"]["point_type3"]."',"
              . " `point_type4`='".$data["major_plans"]["point_type4"]."',"
              . " `point_type5`='".$data["major_plans"]["point_type5"]."',"
              . " `point_type6`='".$data["major_plans"]["point_type6"]."',"
              . " `point_type7`='".$data["major_plans"]["point_type7"]."',"
              . " `point_type8`='".$data["major_plans"]["point_type8"]."' WHERE `major_id`='".$data["major_id"]."';";
      \Base\MySQL::query($string);
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
