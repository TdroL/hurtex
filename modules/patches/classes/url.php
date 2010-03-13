<?php defined('SYSPATH') or die('No direct script access.');

class URL extends Kohana_URL
{
	public static function uri(array $params = array())
	{
		return url::site(Request::instance()->uri($params));
	}
}
