<?php

define('LITHIUM_LIBRARY_PATH', dirname(__DIR__) . '/libraries');

require LITHIUM_LIBRARY_PATH . '/lithium/core/Libraries.php';

use lithium\core\Libraries;

Libraries::add('lithium');

use lithium\data\Connections;

Connections::add('default', array(
	'type' =>  'MongoDb',
	'database' => 'phpnw',
	'host' => 'localhost'
));

Libraries::add('models', array('path' => __DIR__ . '/models'));

use models\Posts;

$posts = Posts::create(array('title' => 'Hi Guys'));
$posts->save();

?>