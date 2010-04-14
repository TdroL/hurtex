<?php defined('SYSPATH') or die('No direct script access.');

class Model_Unit extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
				'id' => new Field_Primary,
				'name' => new Field_String(array(
				)),
				'type' => new Field_Enum(array(
					'choices' => array('integer', 'float'),
				)),
			));
	}

}