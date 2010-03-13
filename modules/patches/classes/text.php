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
}