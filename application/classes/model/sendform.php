<?php defined('SYSPATH') or die('No direct script access.');

class Model_Sendform extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->table('send_form')
			->fields(array(
				'id' => new Field_Primary,
				'name' => new Field_String(array(
					'label' => 'Nazwa',
				)),
				'price' => new Field_Price(array(
					'label' => 'Cena',
				)),
			));
	}

}