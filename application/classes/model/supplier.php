<?php defined('SYSPATH') or die('No direct script access.');

class Model_Supplier extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
				'id' => new Field_Primary,
				'name' => new Field_String(array(
					'label' => 'Nazwa',
					'filters' => array(
						'trim' => NULL,
					),
					'rules' => array(
						'not_empty' => NULL,
					),
				)),
				'address' => new Field_Text(array(
					'label' => 'Adres',
					'filters' => array(
						'trim' => NULL,
					),
					'rules' => array(
						'not_empty' => NULL,
					),
				)),
				'products' => new Field_ManyToMany(array(
					'label' => 'Produkty',
				)),
			))
			->sorting(array(':name_key' => 'asc'));
	}

}