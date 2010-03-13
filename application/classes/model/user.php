<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_User extends Model_Auth_User {
	
	protected $_rules = array
	(
		'username' => array
		(
			'not_empty'			=> NULL,
			'min_length'		=> array(4),
			'max_length'		=> array(32),
			'regex'				=> array('/^[-\pL\pN_.]++$/uD'),
		),
		'password' => array
		(
			'not_empty'			=> NULL,
			'min_length'		=> array(5),
			'max_length'		=> array(42),
		),
		'password_confirm' => array
		(
			'matches'			=> array('password'),
		),
		'nick' => array(
			'not_empty'			=> NULL,
		),
	);

	protected $_callbacks = array
	(
		'username'				=> array('value_avaible'),
	);
	
} // End User Model