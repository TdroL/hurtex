<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_FormFields implements ArrayAccess, Iterator
{
	protected $_data = array();
	protected $_ignored = array('password', 'password_confirm');
	public static $_separator = ', ';

	public function __construct($values = array())
	{
		$this->reset();
		
		if($values instanceof ORM)
		{
			$values->override($this);
			$this->clean();
			return;
		}
	
		if($values instanceof Validate)
		{
			$values = $values->as_array();
		}
		
		$this->_data = array_merge($this->_data, $values);
		
		$this->clean();
	}
	
	public function factory($values = array())
	{
		return new FormFields($values);
	}

	public function ignore() // ignore(...) - ignore('field1', 'field2') or ignore(array('field1', 'field2'))
	{
		foreach(func_get_args() as $v)
		{
			if(is_array($v))
			{
				$this->_ignored = array_merge($this->_ignored, $v);
			}
			elseif(is_string($v))
			{
				$this->_ignored[] = $v;
			}
		}
		return $this;
	}

	public function set($values)
	{
		if($values instanceof ORM)
		{
			$values->override($this);
			$this->clean();
			return;
		}

		if($values instanceof Validate)
		{
			$values = $values->as_array();
		}

		foreach($values as $k => $v)
		{
			$this->_data[$k] = $v;
		}

		$this->clean();
		return $this;
	}

	public function reset()
	{
		$this->_data = array();
		$this->_data['sand'] = $this->sand();
		return $this;
	}

	public function clean()
	{
		foreach($this->_data as $k => $v)
		{
			if(in_array($k, $this->_ignored))
			{
				unset($this->_data[$k]);
			}
		}
		
		return $this;
	}

	public function sand()
	{
		$r = Request::instance();
		return join('-', array($r->directory, $r->controller, $r->action)).'$'.uniqid();
	}

	// -------------- SPL --------------- //

	public function __get($key)
	{
		if(in_array($key, $this->_ignored))
		{
			return NULL;
		}
		return array_key_exists($key, $this->_data) ? $this->_data[$key] : NULL;
	}

	public function __set($key, $value)
	{
		if(in_array($key, $this->_ignored))
		{
			return;
		}
		$this->_data[$key] = $value;
	}

	public function __isset($key)
	{
		return array_key_exists($key, $this->_data);
	}

	public function __unset($key)
	{
		if(array_key_exists($key, $this->_data))
		{
			unset($this->_data[$key]);
		}
	}

	public function offsetExists($key)
	{
		return array_key_exists($key, $this->_data);
	}

	public function offsetGet($key)
	{
		if(in_array($key, $this->_ignored))
		{
			return NULL;
		}
		return array_key_exists($key, $this->_data) ? $this->_data[$key] : NULL;
	}

	public function offsetSet($key, $value)
	{
		if(in_array($key, $this->_ignored))
		{
			return;
		}
		$this->_data[$key] = $value;
	}

	public function offsetUnset($key)
	{
		if(array_key_exists($key, $this->_data))
		{
			unset($this->_data[$key]);
		}
	}

	public function rewind() {
		return reset($this->_data);
	}

	public function current() {
		return current($this->_data);
	}

	public function key() {
		return key($this->_data);
	}

	public function next() {
		return next($this->_data);
	}

	public function valid() {
		return key($this->_data) !== NULL;
	}
	
	public function __toString()
	{
		if(IN_PRODUCTION)
		{
			foreach($this->_data as $k => $v)
			{
				if(is_null($v))
				{
					unset($this->_data[$k]);
				}
			}
			return join(self::$_separator, $this->_data);
		}

		foreach($this->_data as $k => $v)
		{
			if(is_string($v))
			{
				$v = '"'.$v.'"';
			}
			else if(is_null($v))
			{
				$v = 'NULL';
			}

			$this->_data[$k] = $k.':'.$v;
		}
		return '[(FormFields) '.join(self::$_separator, $this->_data).']';
		// mo¿na bylo print_r, ale...
	}
}