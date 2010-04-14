<?php defined('SYSPATH') or die('No direct script access.');

class Model_Supplier extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
				'id' => new Field_Primary,
				'name' => new Field_String(array(
				)),
				'address' => new Field_String(array(
				)),
				'products' => new Field_ManyToMany(array(
				)),
			));
	}

}