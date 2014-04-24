<?php
/**
* MySQL Class
* code by Xiaoyu Tai, 2014-3-22 @Beijing.
*/

namespace Base;

class MySQL{
  private static $location;
  private static $username;
  private static $password;
  private static $database;
  private static $con;
  public function __construct(){
    return null;
  }
  public function init($location, $username, $password, $database){
    self::$location = $location;
    self::$username = $username;
    self::$password = $password;
    self::$database = $database;
  }
  public static function query($query_string){
    self::connect();
    $result = mysql_query($query_string);
    self::close();
    return $result;
  }
  private static function connect(){
    if(!is_null(self::$location)){
      self::$con = mysql_connect(self::$location, self::$username, self::$password);
      if(!self::$con){
        die("Could not connect: " . mysql_error());
        return 0;
      } 
      mysql_query("SET NAMES UTF8;");
      mysql_select_db(self::$database, self::$con);
      date_default_timezone_set("Asia/Hong_Kong");
      return 1;
    }else{
      return 0;
    }
  }
  private static function close(){
    mysql_close(self::$con);
    return 1;
  }
}

/*
class M extends MySQL{
  public function __construct(){
    return null;
  }
  public function a(){
    $result = MySQL::query("SELECT * FROM majors;");
    $row = mysql_fetch_array($result);
    echo $row[0];
  }
}
$M = new MySQL();
$M->init("localhost", "tai", "12345678", "xg_courses");

$MM = new M();
$MM->a();*/