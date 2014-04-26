<?php
/**
* View Class -> to display webpages
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.25
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*/

namespace View;

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
  public function cards($time, $type, $option){
    $i = 0;
    foreach($this->data["subject_list"] as $value){
      if($value["subject_type"]==$type && $value["subject_time"]==$time){
        $i++;
        echo "<div class=\"subjects type_".($value["subject_type"]-2);
        if($value["user_id"]){
          echo " checked";
        }
        echo "\" id=\"".$value["subject_id"]."\" onclick=\"change_val(".$value["subject_id"].","
          . ($value["subject_type"]-2).",".$value["subject_point"].")\">"
        . "<p style=\"font-weight:600; font-size: 18px; color:#D55;\"><a id=\"title".$value["subject_id"]."\""
        . " onclick=\"avoid_val(".$value["subject_id"].",".($value["subject_type"]-2).",".$value["subject_point"].");\""
        . " href=\"".$this->path."/subject/".$value["subject_id"]."/\">".$value["subject_name"]."</a></p>"
        . "<hr /><p style=\"text-align: right;\">已选 <span id=\"enroll_".$value["subject_id"]."\">"
        . $value["subject_enroll"]."</span> 人 | ".$value["subject_examtype"]." | ".$value["subject_point"]." 学分 | ";
        if($option == "mine"){
          echo "<strong>已选</strong>";
        }else{
          echo "<input id=\"box".$value["subject_id"]."\" type=\"checkbox\" name=\"".$value["subject_id"]."\""
          . " onclick=\"change_val_2(".$value["subject_id"].",".($value["subject_type"]-2).",".$value["subject_point"].")\" ";
          if($value["user_id"]){
            echo "checked=\"\" ";
          }
          echo"/>";
        }
        echo "</p></div>";
      }
    }
    if($i == 0){
      echo "<div class=\"subjects\"><p style=\"text-align:center; font-weight:200; font-size: 16px; margin-top:18px; margin-bottom:16px;\">N/A</p></div>";
    }
    return 1;
  }
  private function view(){
    if($this->viewname == "mit"){
      include_once __DIR__ . "/assets/mit.html";
      return 1;
    }else{
      include_once __DIR__ . "/assets/header.html";
      if($this->viewname == "login" || $this->viewname == "admin_login"){
        echo "<div class=\"container\">";
        include_once __DIR__ . "/assets/".$this->viewname.".html";
        if(isset($_SESSION['xg_wrong_password'])){
          unset($_SESSION['xg_wrong_password']);
          echo "<script type=\"text/javascript\">wrong_pwd();</script>";
        }
      }else{
        if(preg_match("/admin_(.*)?/", $this->viewname, $matches)){
          include_once __DIR__ . "/assets/admin_navbar.html";
          include_once __DIR__ . "/admin/".$matches[1].".html";
        }else{
          include_once __DIR__ . "/assets/navbar.html";
          include_once __DIR__ . "/user/".$this->viewname.".html";
        }
        echo "<script type=\"text/javascript\">$(document).ready(function(){nav_active(".$this->data["nav"].");});</script>";
        include_once __DIR__ . "/assets/footer_.html";
      }
      include_once __DIR__ . "/assets/footer.html";
      return 1;
    }
  }
}