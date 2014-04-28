<?php
/**
* Application Class
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.26
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
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
    global $path;
    // in case running on port other than 80
    if($_SERVER['SERVER_PORT'] != 80){
      $path .= ":".$_SERVER['SERVER_PORT'];
    }
    include_once __DIR__ . "/../routes.php";
    $router->run();
  }
}