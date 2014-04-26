<?php
/**
* Class Major -> DB table majors + major_class + major_plans
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.24
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*/

namespace Major;

class Major extends \Base\Objects{
  protected $major_id;
  protected $major_name;
  protected $major_startyear;
  protected $major_endyear;
  protected $plan_link;

  protected $class_list;
  protected $major_plans;

	public function __construct(){
		return null;
	}
}