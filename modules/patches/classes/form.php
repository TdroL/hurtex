<?php defined('SYSPATH') OR die('No direct access allowed.');
class Form extends Kohana_Form 
{
	public static $auto_id = TRUE;
	
	public static function open($action = NULL, array $attributes = NULL)
	{
		return parent::open($action, $attributes).PHP_EOL;
	}

	public static function close()
	{
		return parent::close().PHP_EOL;
	}

	public static function input($name, $value = NULL, array $attributes = NULL)
	{
		if(!isset($attributes['id']) and self::$auto_id)
		{
			$attributes['id'] = 'field-'.$name;
		}
		return parent::input($name, $value, $attributes).PHP_EOL;
	}

	public static function hidden($name, $value = NULL, array $attributes = NULL)
	{
		if(!isset($attributes['id']) and self::$auto_id)
		{
			$attributes['id'] = 'field-'.$name;
		}
		return parent::hidden($name, $value, $attributes).PHP_EOL;
	}

	public static function password($name, $value = NULL, array $attributes = NULL)
	{
		if(!isset($attributes['id']) and self::$auto_id)
		{
			$attributes['id'] = 'field-'.$name;
		}
		return parent::password($name, $value, $attributes).PHP_EOL;
	}

	public static function file($name, array $attributes = NULL)
	{
		if(!isset($attributes['id']) and self::$auto_id)
		{
			$attributes['id'] = 'field-'.$name;
		}
		return parent::file($name, $attributes).PHP_EOL;
	}

	public static function checkbox($name, $value = NULL, $checked = FALSE, array $attributes = NULL)
	{
		if(!isset($attributes['id']) and self::$auto_id)
		{
			$attributes['id'] = 'field-'.$name.'-'.url::title($value);
		}
		return parent::checkbox($name, $value, $checked, $attributes).PHP_EOL;
	}

	public static function radio($name, $value = NULL, $checked = FALSE, array $attributes = NULL)
	{
		if(!isset($attributes['id']) and self::$auto_id)
		{
			$attributes['id'] = 'field-'.$name.'-'.url::title($value);
		}
		return parent::radio($name, $value, $checked, $attributes).PHP_EOL;
	}

	public static function textarea($name, $body = '', array $attributes = NULL, $double_encode = TRUE)
	{
		if(!isset($attributes['id']) and self::$auto_id)
		{
			$attributes['id'] = 'field-'.$name;
		}
		return parent::textarea($name, $body, $attributes, $double_encode).PHP_EOL;
	}

	public static function select($name, array $options = NULL, $selected = NULL, array $attributes = NULL)
	{
		if(!isset($attributes['id']) and self::$auto_id)
		{
			$attributes['id'] = 'field-'.$name;
		}
		return parent::select($name, $options, $selected, $attributes).PHP_EOL;
	}

	public static function submit($name, $value, array $attributes = NULL)
	{
		if(!isset($attributes['id']) and self::$auto_id)
		{
			$attributes['id'] = 'field-'.$name;
		}
		return parent::submit($name, $value, $attributes).PHP_EOL;
	}

	public static function button($name, $body, array $attributes = NULL)
	{
		if(!isset($attributes['id']) and self::$auto_id)
		{
			$attributes['id'] = 'field-'.$name;
		}
		return parent::button($name, $body, $attributes).PHP_EOL;
	}

	public static function label($input, $text = NULL, array $attributes = NULL)
	{
		return parent::label($input, $text, $attributes).PHP_EOL;
	}

} // End form
