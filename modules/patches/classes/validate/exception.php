<?php defined('SYSPATH') or die('No direct script access.');

class Validate_Exception extends Kohana_Validate_Exception
{
	public function errors($messages = 'validate')
	{
		return $this->array->errors($messages);
	}
}