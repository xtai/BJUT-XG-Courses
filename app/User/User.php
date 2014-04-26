<?php
/**
* Class User -> DB table users + user_subject
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.24
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*/

namespace User;

class User extends \Base\Objects{
	protected $user_id;
  protected $major_id;
  protected $class_id;
	protected $user_password;
	protected $user_name;
	protected $user_lastlogin;
	protected $user_logintimes;
	protected $user_lastpwdchange;

  protected $selected_list;

  protected $got_points;

	public function __construct(){
		return null;
	}
}