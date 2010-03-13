<?php defined('SYSPATH') OR die('No direct access allowed.');
class Form extends Kohana_Form 
{

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
		return parent::input($name, $value, $attributes).PHP_EOL;
	}

	public static function hidden($name, $value = NULL, array $attributes = NULL)
	{
		return parent::hidden($name, $value, $attributes).PHP_EOL;
	}

	public static function password($name, $value = NULL, array $attributes = NULL)
	{
		return parent::password($name, $value, $attributes).PHP_EOL;
	}

	public static function file($name, array $attributes = NULL)
	{
		return parent::file($name, $attributes).PHP_EOL;
	}

	public static function checkbox($name, $value = NULL, $checked = FALSE, array $attributes = NULL)
	{
		return parent::checkbox($name, $value, $checked, $attributes).PHP_EOL;
	}

	public static function radio($name, $value = NULL, $checked = FALSE, array $attributes = NULL)
	{
		return parent::radio($name, $value, $checked, $attributes).PHP_EOL;
	}

	public static function textarea($name, $body = '', array $attributes = NULL, $double_encode = TRUE)
	{
		return parent::textarea($name, $body, $attributes, $double_encode).PHP_EOL;
	}

	public static function select($name, array $options = NULL, $selected = NULL, array $attributes = NULL)
	{
		return parent::select($name, $options, $selected, $attributes).PHP_EOL;
	}

	public static function submit($name, $value, array $attributes = NULL)
	{
		return parent::submit($name, $value, $attributes).PHP_EOL;
	}

	public static function button($name, $body, array $attributes = NULL)
	{
		return parent::button($name, $body, $attributes).PHP_EOL;
	}

	public static function label($input, $text = NULL, array $attributes = NULL)
	{
		return parent::label($input, $text, $attributes).PHP_EOL;
	}

} // End form
