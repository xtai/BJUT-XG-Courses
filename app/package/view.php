<?php
  /**
  * View Class
  */
  class View{
    public $name;
    public $title;
    public $path;
    public $bg;
    public $nav;
    private $User;
    private $Subject;
    private $MySQL;
    private $Admin;
    public function __construct($MySQL, $User, $Subject, $Admin, $path){
      ini_set("date.timezone","Asia/Hong_Kong");
      $this->MySQL   = $MySQL;
      $this->User    = $User;
      $this->Subject = $Subject;
      $this->Admin   = $Admin;
      $this->path    = $path;
    }
    public function path($path){
      $this->path = $path;
    }
    public function show($name, $title, $nav, $bg){
      $this->name  = $name;
      $this->title = $title;
      $this->bg    = $bg;
      $this->nav   = $nav;
      $this->view();
    }
    private function view(){
      if(!$this->User->login_state() && ($this->name == "login" || $this->name == "admin_login")){
        include_once "views/header.html";
        echo "<div class=\"container\">";
        include_once "views/".$this->name.".html";
        include_once "views/footer.html";
      }elseif($this->User->login_state()){
        if($this->name == "login" || $this->name == "admin_login"){
          header("Location: ".$this->path."/home.php");
        }else{
          include_once "views/header.html";
          if($this->User->user_data("type") == "users"){
            include_once "views/navbar.html";
          }elseif($this->User->user_data("type") == "admins"){
            include_once "views/admin_navbar.html";
          }
          include_once "views/".$this->name.".html";
          include_once "views/footer.html";
        }
      }else{
        header("Location: ".$this->path);
      }
    }
  }
?>