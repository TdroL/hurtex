<?php defined('SYSPATH') or die('No direct script access.');

class Model_Vat extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->name_key('name')
			->fields(array(
				'id' => new Field_Primary,
				'name' => new Field_String(array(
					'label' => 'Nazwa',
					'unique' => TRUE,
					'rules' => array(
						'not_empty' => NULL,
					),
				)),
				'value' => new Field_Float(array(
					'label' => 'Wartość',
					'default' => '0.00',
					'rules' => array(
						'range' => array(0, 1),
					),
				)),
			));
	}

}