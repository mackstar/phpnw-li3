<?php

define('LITHIUM_LIBRARY_PATH', dirname(__DIR__) . '/libraries');
define('LITHIUM_APP_PATH', __DIR__ . '/templates');

require LITHIUM_LIBRARY_PATH . '/lithium/core/Libraries.php';

use lithium\core\Libraries;
use lithium\core\Environment;
use lithium\action\Dispatcher;
use lithium\g11n\Message;
use lithium\net\http\Media;

Libraries::add('lithium');
Libraries::add('li3_docs');
Libraries::add('templates', array('path' => __DIR__ . '/templates', 
'default' => true));
Libraries::add('adapters', array('path' => __DIR__ . '/adapters'));

Libraries::add('li3_docs', array(
    'index' => array('lithium', 'adapters')
));

$locale = 'en';
$locales = array('en' => 'English');

Environment::set('development', compact('locale', 'locales'));
Environment::set('development');
Dispatcher::applyFilter('run', function($self, $params, $chain) {
	foreach (array_reverse(Libraries::get()) as $name => $config) {
		if ($name === 'lithium') {
			continue;
		}
		$file = "{$config['path']}/config/routes.php";
		file_exists($file) ? call_user_func(function() use ($file) { include $file; }) : null;
	}
	return $chain->next($self, $params, $chain);
});

Media::applyFilter('_handle', function($self, $params, $chain) {
  $params['handler'] += array('outputFilters' => array());
  $params['handler']['outputFilters'] += Message::aliases();
  return $chain->next($self, $params, $chain);
});

echo lithium\action\Dispatcher::run(new lithium\action\Request());

?>