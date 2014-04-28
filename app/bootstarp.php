<?php
/**
* Bootstrap
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.25
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*/
// Need configuration file to work
if(!file_exists(__DIR__ . "/config.php")){
  error_log("Needed Config File, Copy /app/config_example.php -> /app/config.php");
  die();
}
// Include all Classes
include_once __DIR__ . "/config.php";
include_once __DIR__ . "/Base/MySQL.php";
include_once __DIR__ . "/View/View.php";
foreach(glob(__DIR__ . "/*/*.php") as $filename){
  include_once $filename;
}

// Initializing Application
$App = new \Base\Application();

// Run it
$App->run();

?>