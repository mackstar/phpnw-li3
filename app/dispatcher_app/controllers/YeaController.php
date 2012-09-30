<?php

namespace dispatcher_app\controllers;

class YeaController extends \lithium\action\Controller{
	public function index() {
		$Yeah = true;
		return compact('Yeah');
	}
	
	public function render(array $options = array()) {
		echo 'The response of Yeah is: ' . $this->_render['data']['Yeah'];
	}
}

?>