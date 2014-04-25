<?php
/**
* View Class -> to display webpages
*
* @author Xiaoyu Tai @ Beijing, 2014-4-25
*
*/

namespace View;

use \Moudle\MoudleAdmin;
use \Moudle\MoudleUser;

class View{
  private $viewname;
  private $data;
  private $path;
  public function __construct($title, $bg, $nav){
    global $path;
    $this->data["title"] = $title;
    $this->data["bg"]    = $bg;
    $this->data["nav"]   = $nav;
    $this->path          = $path;
    return null;
  }
  public function setData($array){
    $this->data = array_merge($this->data, $array);
    return 1;
  }
  public function show($viewname){
    $this->viewname = $viewname;
    $this->view();
    return 1;
  }
  private function view(){
    if($this->viewname == "mit"){
      include_once __DIR__ . "/assets/mit.html";
      return 1;
    }elseif($this->viewname == "login" || $this->viewname == "admin_login"){
      include_once __DIR__ . "/assets/header.html";
      echo "<div class=\"container\">";
      include_once __DIR__ . "/assets/".$this->viewname.".html";
      if(isset($_SESSION['xg_wrong_password'])){
        unset($_SESSION['xg_wrong_password']);
        echo "<script type=\"text/javascript\">wrong_pwd();</script>";
      }
      include_once __DIR__ . "/assets/footer.html";
      return 1;
    }else{
      include_once __DIR__ . "/assets/header.html";
      if(preg_match("/admin_.*/", $this->viewname)){
        include_once __DIR__ . "/assets/admin_navbar.html";
      }else{
        include_once __DIR__ . "/assets/navbar.html";
      }
      echo "<script type=\"text/javascript\">$(document).ready(function(){nav_active(".$this->data["nav"].");});</script>";
      include_once __DIR__ . "/assets/".$this->viewname.".html";
      include_once __DIR__ . "/assets/footer_.html";
      include_once __DIR__ . "/assets/footer.html";
    }
  }

}


