<?php defined('SYSPATH') or die('No direct script access.');

class Model_Address extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
				'id' => new Field_Primary,
				'address' => new Field_Text(array(
				)),
			));
	}

}