<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'driver' => 'Jelly',
	'hash_method' => 'sha1',
	'salt_pattern' => '2, 7, 8, 12, 15, 16, 21, 23, 27, 30',
	'lifetime' => 1209600,
	'session_key' => 'auth_user',
	'users' => array
	(
		// 'admin' => 'b3154acf3a344170077d11bdb5fff31532f679a1919e716a02',
	),
);
