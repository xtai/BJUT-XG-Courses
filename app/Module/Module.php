<?php
/**
* Class Module
* Data Access Object
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.25
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*/

namespace Module;

class Module{
  public function __construct(){
    return null;
  }
  static public function logout(){
    session_unset();
    return 1;
  }
  static protected function md5Password($password){
    return md5($password . 'taixiaoyu');
  }
  public function getData($viewname){
    return array();
  }
}
