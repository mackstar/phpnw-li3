<?php

Cache::config(array(
	'default' => array(
		'adapter' => '\lithium\storage\cache\adapter\\' . ($apcEnabled ? 'Apc' : 'File')
	)
));

Dispatcher::applyFilter('run', function($self, $params, $chain) {
	$key = md5(LITHIUM_APP_PATH) . '.app.cache.'.md5($params['request']->url);
	if($cache = Cache::read('default', $key)) {
		return $cache;
	}

	$result = $chain->next($self, $params, $chain);

	Cache::write('default', $key, $result, '+1 day');
	return $result;
});


