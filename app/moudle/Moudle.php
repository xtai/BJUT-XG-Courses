<?php
/**
*
* Class Moudle
*
* Data Access Object
*
* author: Xiaoyu Tai @ Beijing, 2014.4.25
*
*/

namespace Moudle;

class Moudle{
  public function __construct(){
    return null;
  }
  static public function logout(){
    session_unset();
    return 1;
  }
  static protected function md5_password($password){
    return md5($password . 'taixiaoyu');
  }
  public function getData($viewname){
    return array();
  }
}
