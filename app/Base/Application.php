<?php
/**
* MySQL Class
* code by Xiaoyu Tai, 2014-3-22 @Beijing.
*/

namespace Base;

class Application{
  public function run(){
    $MySQL = new \Base\MySQL();
    $MySQL->init("localhost", "tai", "12345678", "xg_courses");
  }
}