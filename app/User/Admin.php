<?php
/**
*
* Class Admin -> DB table admins
*
* author: Xiaoyu Tai @ Beijing, 2014.4.24
*
*/

namespace User;

use Base\Objects;

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