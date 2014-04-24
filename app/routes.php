<?php
$router = new \Base\Router();
$router->set404(function() {
  header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
  echo '404, route not found!';
});

$router->get('/', function(){
  echo ": )";
});

$router->get('/t', function(){
  $MD = new \Major\MajorDAO();
  $C = $MD->get("11110");
  echo $C->get("major_name") . "\n";
});

$router->run();