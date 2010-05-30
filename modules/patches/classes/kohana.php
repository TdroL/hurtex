<?php defined('SYSPATH') or die('No direct script access.');

class Kohana extends Kohana_Core
{
	public static function cache($name, $data = NULL, $lifetime = 60)
	{
		try
		{
			return parent::cache($name, $data, $lifetime);
		}
		catch(Exception $e)
		{
			if(preg_match('/unlink\(\/application\/cache\/.+?\)/i', $e->getMessage()))
			{
				!IN_PRODUCTION and Kohana::$log->add('cache', $e.PHP_EOL.'URI: '.$request->uri);
				return NULL;
			}

			throw $e; // rethrow
		}
	}
}

