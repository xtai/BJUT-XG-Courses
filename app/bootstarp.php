<?php
/**
* XG-Courses Bootstrap
* by Xiaoyu Tai @ Beijing, 2014.4.25
*/

$runtime_start = microtime(true);
foreach (glob(__DIR__ . "/*/*.php") as $filename){
  require_once $filename;
}
$MySQL = new \Base\MySQL();
$MySQL->init("localhost", "tai", "12345678", "xg_courses");

require_once __DIR__ . "/routes.php";

$runtime_stop = microtime(true);
echo "\n<br /> Processed in ".round(($runtime_stop-$runtime_start)*1000, 2)." ms";

?>