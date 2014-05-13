<?php
/**
* Class Model
* Data Access Object
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.25
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*/

namespace Model;

class Model{
  public function __construct(){
    return null;
  }
  static public function logout(){
    session_unset();
    return 1;
  }
  static public function md5Password($password){
    return md5($password . 'taixiaoyu');
  }
  public function getData($viewname){
    return array();
  }
}
