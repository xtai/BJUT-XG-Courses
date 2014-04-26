<?php
/**
* Bootstrap
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.25
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*/
include_once __DIR__ . "/config.php";
include_once __DIR__ . "/Base/MySQL.php";
include_once __DIR__ . "/View/View.php";
foreach(glob(__DIR__ . "/*/*.php") as $filename){
  include_once $filename;
}

$App = new \Base\Application();

?>