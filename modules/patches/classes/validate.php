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
	
	public function account_number($p_iNRB)
	{
		// Usuniecie spacji
		$iNRB = utf8::str_ireplace(' ', '', $p_iNRB);
		// Sprawdzenie czy przekazany numer zawiera 26 znaków
		if(utf8::strlen($iNRB) != 26)
		{
			die('fail #1');
			return false;
		}
		
		// Zdefiniowanie tablicy z wagami poszczególnych cyfr				
		$aWagiCyfr = array(1, 10, 3, 30, 9, 90, 27, 76, 81, 34, 49, 5, 50, 15, 53, 45, 62, 38, 89, 17, 73, 51, 25, 56, 75, 71, 31, 19, 93, 57);
	 
		// Dodanie kodu kraju (w tym przypadku dodajemy kod PL)		
		$iNRB = $iNRB.'2521';
		$iNRB = utf8::substr($iNRB, 2).utf8::substr($iNRB, 0, 2); 
	 
		// Wyzerowanie zmiennej
		$iSumaCyfr = 0;
	 
		// Pćtla obliczająca sumć cyfr w numerze konta
		for($i = 0; $i < 30; $i++) 
			$iSumaCyfr += $iNRB[29-$i] * $aWagiCyfr[$i];
	 
		// Sprawdzenie czy modulo z sumy wag poszczegolnych cyfr jest rowne 1
		return ($iSumaCyfr % 97 == 1);
	}
} // End Validation
