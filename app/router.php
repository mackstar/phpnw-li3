<?php

define('LITHIUM_LIBRARY_PATH', dirname(__DIR__) . '/libraries');
require LITHIUM_LIBRARY_PATH . '/lithium/core/Libraries.php';

use lithium\core\Libraries;
Libraries::add('lithium');

use lithium\net\http\Router;
use lithium\action\Request;

$request = new Request();
$router = new Router();

$router->connect('/cool-root', array('controller' => 'Yea'));
$router->connect('/cool-root/{:application_id:[0-9]{1}}', array('controller' => 'Yea'));
$router->parse($request);

echo Router::match('Yea::index');
echo Router::match(array('Yea::index', 'application_id' => 1)); 

?>