<?php
/**
*
* Class User -> DB table users + user_subject
*
* author: Xiaoyu Tai @ Beijing, 2014.4.24
*
*/

namespace User;

use Base\Objects;

class User extends \Base\Objects{
	protected $user_id;
  protected $major_id;
  protected $class_id;
	protected $user_password;
	protected $user_name;
	protected $user_lastlogin;
	protected $user_logintimes;
	protected $user_lastpwdchange;

  protected $subject_selected_list;

	public function __construct(){
		return null;
	}
}