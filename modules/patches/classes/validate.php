<?php defined('SYSPATH') or die('No direct script access.');

class Validate extends Kohana_Validate
{
	public function errors($file = NULL, $translate = TRUE)
	{
		if ($file === NULL)
		{
			// Return the error list
			return $this->_errors;
		}

		// Create a new message list
		$messages = array();

		foreach ($this->_errors as $field => $set)
		{
			list($error, $params) = $set;

			// Get the label for this field
			$label = $this->_labels[$field];

			if ($translate)
			{
				// Translate the label
				$label = __($label);
			}

			// Start the translation values list
			$values = array(':field' => $label);

			if ($params)
			{
				foreach ($params as $key => $value)
				{
					// Add each parameter as a numbered value, starting from 1
					$values[':param'.($key + 1)] = $value;
				}
			}

			if($error == 'matches')
			{
				$label = $this->_labels[$values[':param1']];
				if ($translate)
				{
					// Translate the label
					$label = __($label);
				}
				$values[':param1'] = $label;
			}

			if ($message = Kohana::message($file, "{$field}.{$error}"))
			{
				// Found a message for this field and error
			}
			elseif ($message = Kohana::message($file, "{$field}.default"))
			{
				// Found a default message for this field
			}
			elseif ($message = Kohana::message('validate', $error))
			{
				// Found a default message for this error
			}
			else
			{
				// No message exists, display the path expected
				$message = "{$file}.{$field}.{$error}";
			}

			if ($translate == TRUE)
			{
				if (is_string($translate))
				{
					// Translate the message using specified language
					$message = __($message, $values, $translate);
				}
				else
				{
					// Translate the message using the default language
					$message = __($message, $values);
				}
			}
			else
			{
				// Do not translate, just replace the values
				$message = strtr($message, $values);
			}

			// Set the message for this field
			$messages[$field] = $message;
		}

		return $messages;
	}
	
	public function fields($fields)
	{
		$file = $fields;
		$path = NULL;
		
		if(strpos($fields, '.', 1))
		{
			list($file, $path) = explode('.', $fields, 2);
		}
		
		$fields = Kohana::message($file, $path);
		
		return parent::labels($fields);
	}
	
	/* --- Validatition funcs --- */

	public static function phone($number, $lengths = NULL)
	{
		return parent::phone(preg_replace('/\s/i', '', $number), $lengths);
	}

	public function nip($value)
	{
		if(!empty($value))
		{
				$weights = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
				$nip = preg_replace('/[\D]/', '', (string) $value);
				$sum = 0;
				
				if (utf8::strlen($nip) == 10 && is_numeric($nip))
				{	 
					for($x = 0; $x <= 8; $x++)
					{
						$sum += $nip[$x] * $weights[$x];
					}
					
					if (($sum % 11) == $nip[9])
					{
						return true;
					}
				}
		}
		
		return false;
	}
} // End Validation
