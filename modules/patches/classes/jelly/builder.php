<?php defined('SYSPATH') or die('No direct script access.');

class Jelly_Builder extends Jelly_Builder_Core
{
	protected function _column($field, $join = TRUE, $value = NULL)
	{
		if(!is_string($field))
		{
			return $field;
		}
		
		return parent::_column($field, $join, $value);
	}
	
	public function loaded()
	{
		return !empty($this->_result);
	}
}