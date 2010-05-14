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

		parent::set($values, $value);

		if(!empty($this->_unmapped))
		{
			$related = array();
			
			foreach($this->_meta->fields() as $k => $v)
			{
				if($v instanceof Jelly_Field_Relationship)
				{
					$related[$k] = Jelly::meta($v->foreign['model']);
				}
			}

			if(!empty($related))
			{
				foreach($this->_unmapped as $k => $v)
				{
					foreach($related as $key => $r)
					{
						if($r->fields($k) !== NULL)
						{
							$this->{$key}->set($k, $v);
							continue;
						}
					}
				}
			}
		}
		
		return $this;
	}

	public function original($key)
	{
		return $this->_original[$key];
	}

	public function key_exists($key)
	{
		return array_key_exists($key, $this->_original);
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

