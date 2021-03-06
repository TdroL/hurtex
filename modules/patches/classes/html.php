<?php defined('SYSPATH') or die('No direct script access.');

class HTML extends Kohana_HTML
{
	public static function error_messages($errors = array())
	{
		if(empty($errors))
		{
			return PHP_EOL;
		}
		
		return View::factory('common/errors')->set('errors', $errors).PHP_EOL;
	}
	
	public static function anchor($uri, $title = NULL, array $attributes = NULL, $protocol = NULL)
	{
		if(preg_match('/^admin\/(?<controller>[^\/]++)(?:\/(?<action>[^\/\.]++))?/i', $uri, $matches))
		{
			if(isset($matches['action']) and $matches['action'] == 'details')
			{
				$matches['action'] = 'index';
			}
			
			if(!Auth::instance()->has_role(rtrim($matches['controller'].'.'.$matches['action'], '.')))
			{
				return '';
			}
		}
		
		return parent::anchor($uri, $title, $attributes, $protocol);
	}
	
	public static function anchor_confirm($uri, $title = NULL, $message = NULL, array $attributes = NULL, $protocol = NULL)
	{
		if(!empty($message))
		{
			$attributes['onclick'] = 'return confirm("'.$message.'");';
		}
		
		return static::anchor($uri, $title, $attributes, $protocol);
	}
	
	public static function attributes(array $attributes = NULL)
	{
		if (empty($attributes))
			return '';

		$sorted = array();
		foreach (HTML::$attribute_order as $key)
		{
			if (isset($attributes[$key]))
			{
				// Add the attribute to the sorted list
				$sorted[$key] = $attributes[$key];
			}
		}

		// Combine the sorted attributes
		$attributes = $sorted + $attributes;

		$compiled = '';
		foreach ($attributes as $key => $value)
		{
			if ($value === NULL)
			{
				// Skip attributes that have NULL values
				continue;
			}

			// Add the attribute value
			$compiled .= ' '.$key.'="'.htmlspecialchars($value, ENT_QUOTES, Kohana::$charset, FALSE).'"';
																					// added FALSE param
		}

		return $compiled;
	}
}
