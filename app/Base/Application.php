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
    global $path;
    global $db_location;
    global $db_username;
    global $db_password;
    global $db_database;
    // Start session and configure time zone
    session_start();
    date_default_timezone_set("Asia/Hong_Kong");

    // in case running on port other than 80
    if($_SERVER['SERVER_PORT'] != 80){
      $path .= ":".$_SERVER['SERVER_PORT'];
    }

    // initialize MySQL
    \Base\MySQL::init($db_location, $db_username, $db_password, $db_database);

    // initialize Router
    $router = new \Base\Router();

    // include Fliter Rules
    include_once __DIR__ . "/../fliters.php";

    // include Router Rules
    include_once __DIR__ . "/../routes.php";

    // run Router
    $router->run();
  }
}