<?php
return [
	'module' => [
		'class'  => 'application.modules.music.MusicModule',
	],

	'rules' => [
		'/music' => '/music/default/index',
		'/download/<id:\d+>' => '/music/default/download',
		'/genre/<genre:\d+>' => '/music/default/index',
		'/track/<id:\d+>' => '/music/default/view',
	],
];