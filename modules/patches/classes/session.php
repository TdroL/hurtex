<?php defined('SYSPATH') or die('No direct script access.');

abstract class Session extends Kohana_Session
{
	public function get_once($key, $default = NULL)
	{
		$value = $this->get($key, $default);
		$this->delete($key);
		return $value;
	}
} // End Validation
