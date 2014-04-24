<?php
/**
*
* Class MajorDAO -> DB table majors + major_class + major_plans
*
* Data Access Object
*
* author: Xiaoyu Tai @ Beijing, 2014.4.24
*
*/

namespace Major;

use Base\MySQL;

class MajorDAO extends \Base\MySQL{

  public function __construct(){
    return null;
  }

  public function get($major_id){
  	$Major = new Major();
  	$result = \Base\MySQL::query("SELECT * FROM majors WHERE major_id = '". $major_id ."';");
    $result = mysql_fetch_array($result, MYSQL_ASSOC);
    foreach ($result as $key => $value) {
      $Major->set($key, $value);
    }
  	return $Major;
  }


}
