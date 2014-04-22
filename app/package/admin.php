<?php
  /**
  * Admin Class
  * code by Xiaoyu Tai, 2014-4-21 @Beijing.
  *
  * 
  * . 
  * . 
  * . 
  * . 
  * . 
  */
  class Admin{
    private $path;
    private $MySQL;
    private $User;
    public function __construct($MySQL, $User, $path){
      $this->MySQL = $MySQL;
      $this->User = $User;
      $this->path  = $path;
    }
    
    public function show_data($type){
      switch ($type) {
        case 'users':
          $result = $this->MySQL->query("SELECT DISTINCT id FROM users;");
          return mysql_num_rows($result);
          break;
        case 'subjects':
          $result = $this->MySQL->query("SELECT DISTINCT id FROM subjects;");
          return mysql_num_rows($result);
          break;
        case 'classes':
          $result = $this->MySQL->query("SELECT DISTINCT classnum FROM users;");
          return mysql_num_rows($result);
          break;
        case 'majors':
          $result = $this->MySQL->query("SELECT DISTINCT major FROM users;");
          return mysql_num_rows($result);
          break;
        case 'selects':
          $result = $this->MySQL->query("SELECT * FROM selects;");
          return mysql_num_rows($result);
          break;
        case 'admins':
          $result = $this->MySQL->query("SELECT DISTINCT id FROM admins;");
          return mysql_num_rows($result);
          break;
        default:
          return 0;
          break;
      }
    }

    public function last_login($limit){
      $result = $this->MySQL->query("SELECT * FROM users ORDER BY lastlogin DESC LIMIT ".$limit.";");
      while($user = mysql_fetch_array($result)){
        echo "<p><a href=\"".$this->path."/user.php?u=".$user['id']."\">".$user['name']."</a><span class=\"pull-right\">".$user['lastlogin']."</span></p>";
      }
      return 0;
    }

    public function user_list(){}
  }
?>