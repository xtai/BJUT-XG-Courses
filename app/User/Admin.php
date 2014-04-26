<?php
/**
* Class Admin -> DB table admins
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.24
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*/

namespace User;

class Admin extends \Base\Objects{
	protected $user_id;
	protected $user_password;
	protected $user_name;
	protected $user_lastlogin;
	protected $user_logintimes;
	protected $user_lastpwdchange;

	public function __construct(){
		return null;
	}
}