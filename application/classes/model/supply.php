<?php defined('SYSPATH') or die('No direct script access.');

class Model_Supply extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
				'id' => new Field_Primary,
				'date' => new Field_Timestamp(array(
				)),
				'status' => new Field_Enum(array(
					'choices' => array('added', 'in-progress', 'done', 'canceled'),
				)),
				'products' => new Field_ManyToMany(array(
				)),
			));
	}

}