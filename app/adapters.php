<?php

define('LITHIUM_LIBRARY_PATH', dirname(__DIR__) . '/libraries');
define('LITHIUM_APP_PATH', __DIR__);

require LITHIUM_LIBRARY_PATH . '/lithium/core/Libraries.php';
require LITHIUM_LIBRARY_PATH . '/lithium/core/Object.php';
require LITHIUM_LIBRARY_PATH . '/lithium/core/StaticObject.php';
require LITHIUM_LIBRARY_PATH . '/lithium/core/Environment.php';
require LITHIUM_LIBRARY_PATH . '/lithium/core/Adaptable.php';
require LITHIUM_LIBRARY_PATH . '/lithium/core/ConfigException.php';

use lithium\core\Adaptable;

class Email extends Adaptable{
	
	protected static $_configurations = array();
	protected static $_adapters = 'emails';
	
}

use lithium\core\Libraries;
Libraries::add('lithium');
Libraries::add('adapters', array('path' => __DIR__ . '/adapters'));
Libraries::paths(array('emails' => array('{:library}\{:name}')));

use adapters\EmailReal;

Email::config(array(
	'development' => array(
		'adapter' => 'EmailReal'
	),
	'test' => array(
		'adapter' => 'EmailTest'
	),
));

use lithium\core\Environment;


Environment::set('test');
$env = Environment::get();

Email::adapter($env)->send();


Environment::set('development');

class EmailAnother extends Adaptable{
	
	protected static $_configurations = array();
	protected static $_adapters = 'emails';

	public static function send() {
		$config = static::_config('default');
		static::adapter('default')->send();
	}
	
}
EmailAnother::config(array(
	'default' => array(
		'test' => array (
			'adapter' => 'EmailTest'
		),
		'development' => array(
			'adapter' => 'EmailReal'
		),
	)
));

EmailAnother::send();

?>