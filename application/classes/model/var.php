<?php defined('SYSPATH') or die('No direct script access.');

class Model_Vat extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
				'id' => new Field_Primary,
				'name' => new Field_String(array(
				)),
				'value' => new Field_Float(array(
				)),
			));
	}

}