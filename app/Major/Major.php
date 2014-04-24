<?php
/**
*
* Class Major -> DB table majors + major_class + major_plans
*
* author: Xiaoyu Tai @ Beijing, 2014.4.24
*
*/

namespace Major;

use Base\Objects;

class Major extends \Base\Objects{
  protected $major_id;
  protected $major_name;
  protected $major_startyear;
  protected $major_endyear;

  protected $class_list;
  protected $major_plans;

	public function __construct(){
		return null;
	}
}
/*
$S = new Major();
$S->set("major_id", "123");
echo $S->get("major_id") . "\n";*/
