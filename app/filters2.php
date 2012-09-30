<?php

define('LITHIUM_LIBRARY_PATH', dirname(__DIR__) . '/libraries');
define('LITHIUM_APP_PATH', __DIR__);

require LITHIUM_LIBRARY_PATH . '/lithium/core/Libraries.php';

use lithium\core\Libraries;

Libraries::add('lithium');

class Action extends \lithium\core\Object {

	public function doSomethingStupid() {
		return $this->_filter(__METHOD__, $params, function($self, $params) {
			return $result;
		});
	}
}

use lithium\analysis\Logger;

Logger::config(array(
	'default' => array(
		'adapter' => 'File',
		'path' => __DIR__ . '/crap/logs/'
	)
));


$action = new Action;
$action->applyFilter('doSomethingStupid', function($self, $params, $chain) {
	
	Logger::debug(date("D M j G:i:s") . " " . 'About to do something stupid,');

	$result = $chain->next($self, $params, $chain);

	Logger::debug(date("D M j G:i:s") . " " . 'You total moron!');

	return $result;

});

$action->doSomthingStupid();

?>