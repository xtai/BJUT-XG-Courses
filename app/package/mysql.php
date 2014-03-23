<?php
  /**
  * MySQL Class
  * code by Xiaoyu Tai, 2014-3-22 @Beijing.
  */
  class MySQL{
    private $location;
    private $username;
    private $password;
    private $database;
    private $con;
    public function __construct(){
    }
    public function query($query_string){
      $result;
      self::connect();
      $result = mysql_query($query_string);
      self::close();
      return $result;
    }
    private function init(){
      $this->location = "localhost";
      $this->username = "tai";
      $this->password = "12345678";
      $this->database = "xg_courses";
    }
    private function connect(){
      $this->init();
      $this->con = mysql_connect($this->location, $this->username, $this->password);
      if(!$this->con){
        die("Could not connect: " . mysql_error());
        return 0;
      } 
      mysql_query("SET NAMES UTF8;");
      mysql_select_db($this->database, $this->con);
      date_default_timezone_set("Asia/Hong_Kong");
      return 1;
    }
    private function close(){
      mysql_close($this->con);
      return 1;
    }
  }
?>