<?php
$runtime_start = microtime(true);


include_once __DIR__ . '/../app/bootstarp.php';


$App->run();


echo "\n<span style=\"display: none;\">".round((microtime(true)-$runtime_start)*1000, 2)."</span>";