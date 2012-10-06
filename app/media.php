<?php

Media::type('jsonp', array('text/javascript','application/javascript'), array(
	'view' => 'lithium\template\View',
	'layout' => false,
	'paths' => array(
		'template' => '{:library}/views/{:type}.php',
		'layout' => '{:library}/views/{:type}.layout.php'
	),
	'conditions' => array('type' => true),
	'encode' => function($data, $handler, &$response) {
		return '('.json_encode($data).')';
	}
));

Media::type('jpg', 'image/jpeg', array('cast' => false, 'encode' => function($data) {
	return $data['photo']->file->getBytes();
}));

Media::type('json', 'application/json', array('cast' => false, 'encode' => function($data) {
	return json_encode($data);
}));

Media::type('json', 'application/json', array('cast' => false, 'encode' => 'json_encode'));



?>