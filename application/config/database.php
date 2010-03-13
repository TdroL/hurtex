<?php defined('SYSPATH') OR die('No direct access allowed.');

$_database =  array
(
	'default' => array
	(
		'type'       => 'mysql',
		'connection' => array(
			'hostname'   => 'localhost',
			'username'   => 'root',
			'password'   => FALSE,
			'persistent' => FALSE,
			'database'   => 'hurtex',
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
		'profiling'    => TRUE,
	),
	'alternate' => array(
		'type'       => 'mysql',
		'connection' => array(
			'hostname'   => '***',
			'username'   => '***',
			'password'   => '***',
			'persistent' => FALSE,
			'database'   => '***',
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
		'profiling'    => FALSE,
	),
);

if(IN_PRODUCTION)
{
	$_tmp = $_database['default'];
	$_database['default'] = $_database['alternate'];
	$_database['alternate'] = $_tmp;
	unset($_tmp);
}

return $_database;