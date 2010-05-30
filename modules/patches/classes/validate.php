<?php defined('SYSPATH') or die('No direct script access.');

class Validate extends Kohana_Validate
{
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
