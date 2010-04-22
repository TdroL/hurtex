<?php defined('SYSPATH') or die('No direct script access.');

class Model_Supplier extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
				'id' => new Field_Primary,
				'name' => new Field_String(array(
					'label' => 'Nazwa',
					'rules' => array(
						'not_empty' => NULL,
					),
				)),
				'address' => new Field_String(array(
					'label' => 'Adres',
					'rules' => array(
						'not_empty' => NULL,
					),
				)),
				'products' => new Field_ManyToMany(array(
				)),
			));
	}

}