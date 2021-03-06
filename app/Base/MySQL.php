<?php
/**
* MySQL Class
*
* @author     Xiaoyu Tai @ Beijing, 2014.3.22
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
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
  public static function init($location, $username, $password, $database){
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