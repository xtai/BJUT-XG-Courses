<?php
/**
* Class Subject -> DB table subjects + user_subject
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.24
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*/

namespace Subject;

class Subject extends \Base\Objects{
  protected $subject_id;
  protected $subject_name;
  protected $subject_time;
  protected $subject_type;
  protected $subject_point;
  protected $subject_school;
  protected $subject_examtype;
  protected $major_id;

  protected $subject_enroll;

  protected $enrolled_list;

	public function __construct(){
		return null;
	}
}