<?php

define('LITHIUM_LIBRARY_PATH', dirname(__DIR__) . '/libraries');

require LITHIUM_LIBRARY_PATH . '/lithium/core/Object.php';
require LITHIUM_LIBRARY_PATH . '/lithium/util/Collection.php';
require LITHIUM_LIBRARY_PATH . '/lithium/util/collection/Filters.php';

class Action extends \lithium\core\Object {

  public function doSomethingStupid() {
    return $this->_filter(__METHOD__, $params, function($self, $params) {
        return $result;
    });
  }
}

$action = new Action;
$action->applyFilter('doSomethingStupid', function($self, $params, $chain) {
	echo 'About to do something stupid,';
	$result = $chain->next($self, $params, $chain);
	echo 'You IDIOT!!!!!';
	return $result;
});

$action->doSomthingStupid();
?>