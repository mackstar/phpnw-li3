<?php

define('LITHIUM_LIBRARY_PATH', dirname(__DIR__) . '/libraries');
define('LITHIUM_APP_PATH', __DIR__ . '/templates');

require LITHIUM_LIBRARY_PATH . '/lithium/core/Libraries.php';

use lithium\core\Libraries;

Libraries::add('lithium');
Libraries::add('templates', array('path' => 'templates', 'default' => true));

use lithium\Template\View;

$view = new View(array(
    'paths' => array(
        'template' => 'templates/{:template}.{:type}.php',
        'layout'   => 'templates/{:layout}.{:type}.php',
    )
));

$page = $view->render('all', array('content' => 'content'), array(
    'template' => 'page',
    'layout' => 'layout',
		'type' => 'html'
));

echo $page;

?>