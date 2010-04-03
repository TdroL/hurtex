<?php defined('SYSPATH') or die('No direct script access.');

class Jelly_Model extends Jelly_Model_Core
{
	public function set($values, $value = NULL)
	{
		// Accept set($_POST, array('author', 'body'));
		// Only $_POST['author'] and $_POST['body'] will be passed
		if(is_array($values) and is_array($value))
		{
			$keys = array_flip($value);
			$values = array_intersect_key($values, $keys);

			$value = NULL;
		}

		return parent::set($values, $value);
	}

	public function label($name)
	{
		$field = $this->_meta->fields($name);

		if($field)
		{
			return form::label('field-'.$name, $field->label);
		}

		return ucfirst($name);
	}
}

