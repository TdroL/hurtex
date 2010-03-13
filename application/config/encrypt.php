<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'default' => array(
		'key'    => '$super#tajny?klucz!heh$',
		'mode'   => MCRYPT_MODE_NOFB,
		'cipher' => MCRYPT_RIJNDAEL_128
	),
);
