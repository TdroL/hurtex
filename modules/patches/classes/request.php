<?php defined('SYSPATH') or die('No direct script access.');

class Request extends Kohana_Request 
{
	public static function load($uri)
	{
		return Request::factory($uri)->execute()->send_headers()->response;
	}
	
	public function redirect($url, $code = 302)
	{
		if (strpos($url, '://') === FALSE)
		{
			// Make the URI into a URL
			$url = URL::site($url);
		}

		if($code === 302)
		{
			echo html::anchor($url, empty($url) ? '/' : $url).'<br />';
		}

		// Set the response status
		$this->status = $code;

		// Set the location header
		$this->headers['Location'] = $url;

		// Send headers
		$this->send_headers();

		// Stop execution
		exit;
	}
} // End Request
