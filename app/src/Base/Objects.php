<?php
/**
*
* Class Objects -> DBA tables set() & get()
*
* author: Xiaoyu Tai @ Beijing, 2014.4.24
*
*/

namespace Base;

class Objects{
  public function set($argument, $value){
    if($this->check($argument)){
      $this->$argument = $value;
      return 1;
    }
    return null;
  }

  public function get($argument){
    if($this->check($argument)){
      return $this->$argument;
    }
    return null;
  }

  // Using ReflectionClass to check class variables.
  private function check($argument){
    $reflection = new \ReflectionClass($this);
    $vars = $reflection->getProperties();
    foreach($vars as $var){
      if($argument == $var->getName()){
        return true;
      }
    }
    return false;
  }
}