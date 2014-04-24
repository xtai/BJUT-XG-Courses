<?php
/**
*
* Class Subject -> DB table subjects + user_subject
*
* author: Xiaoyu Tai @ Beijing, 2014.4.24
*
*/

namespace Subject;

use Base\Objects;

class Subject extends \Base\Objects{
  protected $subject_id;
  protected $subject_name;
  protected $subject_time;
  protected $subject_type;
  protected $subject_point;
  protected $subject_school;
  protected $subject_examtype;
  protected $major_id;

  protected $user_enrolled_list;

	public function __construct(){
		return null;
	}
}