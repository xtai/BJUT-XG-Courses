<?php
/**
* index.php
* All triffic go through here -> router
* Remember using rewrite!
*
* @author     Xiaoyu Tai @ Beijing, 2014.4.26
* @copyright  Copyright (c), 2014 Xiaoyu Tai
* @license    MIT license (see /mit/)
*/
// Count Time
$runtime_start = microtime(true);

include_once __DIR__ . '/../app/bootstarp.php';

// Echo total time
echo "\n<b id=\"_t\" style=\"display: none;\">".round((microtime(true)-$runtime_start)*1000)."</b>";