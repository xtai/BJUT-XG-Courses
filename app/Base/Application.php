<?php
/**
* MySQL Class
* code by Xiaoyu Tai, 2014-3-22 @Beijing.
*/

namespace Base;

class Application{
  public function run(){
    global $db_location;
    global $db_username;
    global $db_password;
    global $db_database;
    session_start();
    date_default_timezone_set("Asia/Hong_Kong");
    \Base\MySQL::init($db_location, $db_username, $db_password, $db_database);
    $router = new \Base\Router();
    include_once __DIR__ . "/../routes.php";
    $router->run();
  }
}