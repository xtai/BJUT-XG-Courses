<?php

foreach (glob(__DIR__ . "/*/*") as $filename){
  require_once $filename;
  echo $filename . "\n";
}

$Major = new \Major\Major();
$Major->set("major_name", "xg");
echo $Major->get("major_name") . "\n";