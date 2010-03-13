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
	
	public static function has($url, $params, $return = NULL)
	{
		$bool = TRUE;
		foreach($params as $k => $v)
		{
			if(!array_key_exists($k, $url) or $url[$k] != $v)
			{
				$bool = FALSE;
				break;
			}
		}
		
		if($return !== NULL)
		{
			return ($bool === TRUE) ? $return : NULL;
		}
		
		return $bool;
	}
	
	public static function image($file, array $attributes = NULL, $index = FALSE)
	{
		if(!is_array($attributes))
		{
			$attributes = array();
		}
		
		if(!array_key_exists('alt', $attributes))
		{
			$attributes['alt'] = $file;
			
			if(array_key_exists('title', $attributes))
			{
				$attributes['alt'] = $attributes['title'];
			}
		}
		
		return parent::image($file, $attributes, $index);
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
