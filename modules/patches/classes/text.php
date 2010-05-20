<?php defined('SYSPATH') or die('No direct script access.');

class Text extends Kohana_Text
{
	public static function normalize($string)
	{
		$chars = array(
			'ę' => 'e',
			'ó' => 'o',
			'ą' => 'a',
			'ś' => 's',
			'ł' => 'l',
			'ż' => 'z',
			'ź' => 'z',
			'ć' => 'c',
			'ń' => 'n',
			'Ę' => 'E',
			'Ó' => 'O',
			'Ą' => 'A',
			'Ś' => 'S',
			'Ł' => 'L',
			'Ż' => 'Z',
			'Ź' => 'Z',
			'Ć' => 'C',
			'Ń' => 'N',
		);

		foreach($chars as $k => $v)
		{
			$string = str_ireplace($k, $v, $string);
		}

		return url::string(preg_replace('/[^a-z0-9-\+\/_ ]/iU', '_', $string));
	}
	
	public function number_to_text($value)
	{
		$jednosci = Array( 'zero', 'jeden', 'dwa', 'trzy', 'cztery', 'pięć', 'sześć', 'siedem', 'osiem', 'dziewięć' );
		$dziesiatki = Array( '', 'dziesięć', 'dwadzieścia', 'trzydzieści', 'czterdzieści', 'piećdziesiąt', 'sześćdziesiąt', 'siedemdziesiąt', 'osiemdziesiąt', 'dziewiećdziesiąt' );
		$setki = Array( '', 'sto', 'dwieście', 'trzysta', 'czterysta', 'piećset', 'sześćset', 'siedemset', 'osiemset', 'dziewiećset' );
		$nastki = Array( 'dziesieć', 'jedenaście', 'dwanaście', 'trzynaście', 'czternaście', 'piętnaście', 'szesnaście', 'siedemnaście', 'osiemnaście', 'dzięwietnaście' );
		$tysiace = Array( 'tysiąc', 'tysiące', 'tysięcy' );
	
		$digits = (string) $digits;
		$digits = strrev( $digits );
		$i = strlen( $digits );
	
		$string = '';
	
		if( $i > 5 && $digits[5] > 0 )
			$string .= $setki[ $digits[5] ] . ' ';
		if( $i > 4 && $digits[4] > 1 )
			$string .= $dziesiatki[ $digits[4] ] . ' ';
		elseif( $i > 3 && $digits[4] == 1 )
			$string .= $nastki[$digits[3]] . ' ';
		if( $i > 3 && $digits[3] > 0 && $digits[4] != 1 )
			$string .= $jednosci[ $digits[3] ] . ' ';
	
		$tmpStr = substr( strrev( $digits ), 0, -3 );
		if( strlen( $tmpStr ) > 0 )
		{
			$tmpInt = (int) $tmpStr;
			if( $tmpInt == 1 )
				$string .= $tysiace[0] . ' ';
			elseif( ( $tmpInt % 10 > 1 && $tmpInt % 10 < 5 ) && ( $tmpInt < 10 || $tmpInt > 20 ) )
				$string .= $tysiace[1] . ' ';
			else
				$string .= $tysiace[2] . ' ';
		}
	
		if( $i > 2 && $digits[2] > 0 )
			$string .= $setki[$digits[2]] . ' ';
		if( $i > 1 && $digits[1] > 1 )
			$string .= $dziesiatki[$digits[1]] . ' ';
		elseif( $i > 0 && $digits[1] == 1 )
			$string .= $nastki[$digits[0]] . ' ';
		if( $digits[0] > 0 && $digits[1] != 1 )
			$string .= $jednosci[$digits[0]] . ' ';
	
		return $string;

	}
}