<?php

define('LITHIUM_LIBRARY_PATH', dirname(__DIR__) . '/libraries');

require LITHIUM_LIBRARY_PATH . '/lithium/core/Libraries.php';

use lithium\core\Libraries;

Libraries::add('lithium');
Libraries::add('dispatcher_app', array('path' => __DIR__ . '/dispatcher_app'));

use lithium\net\http\Router;

$router = new Router();

Router::connect('/cool-root', array('controller' => 'Yea', 'library' => 'dispatcher_app'));

echo lithium\action\Dispatcher::run(
	new lithium\action\Request()
);

?>