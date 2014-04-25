<?php
/**
*
* Class Objects -> DBA tables set(), get(), getAll()
*
* author: Xiaoyu Tai @ Beijing, 2014.4.24
*
*/

namespace Base;

class Objects{
  public function set($variable, $value){
    if($this->check($variable)){
      $this->$variable = $value;
      return 1;
    }
    return null;
  }

  public function get($variable){
    if($this->check($variable)){
      return $this->$variable;
    }
    return null;
  }
  
  public function getAll(){
    $result = array();
    $reflection = new \ReflectionClass($this);
    $vars = $reflection->getProperties();
    foreach($vars as $var){
      $result[$var->getName()] = $this->get($var->getName());
    }
    return $result;
  }

  protected function check($variable){
    $reflection = new \ReflectionClass($this);
    $vars = $reflection->getProperties();
    foreach($vars as $var){
      if($variable == $var->getName()){
        return true;
      }
    }
    return false;
  }
}