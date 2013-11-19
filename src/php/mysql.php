<?php
class MySQL{
  private $location;
  private $username;
  private $password;
  private $database;
  function __construct(){
    $this->location = "localhost";
    $this->username = "tai";
    $this->password = "12345678";
    $this->database = "xg_courses";
  }
  public function con(){
    $con = mysql_connect($this->location,$this->username,$this->password);
    if (!$con){
      return 0;
    } 
    mysql_query("SET NAMES UTF8;");
    mysql_select_db($this->database, $con);
    date_default_timezone_set("Asia/Hong_Kong");
    return 1;
  }
  public function close_con(){
    $con = mysql_connect("$this->location","$this->username","$this->password");
    mysql_close($con);
  }
}
?>