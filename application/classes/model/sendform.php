<?php defined('SYSPATH') or die('No direct script access.');

class Model_Sendform extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta//->name_key('name')
			->fields(array(
				'id' => new Field_Primary,
				'name' => new Field_String(array(
					'label' => 'Nazwa',
				)),
				'value' => new Field_Float(array(
					'label' => 'Koszt wysyłki',
					'column' => 'price',
					'default' => 0,
				)),
			))
			->sorting(array('value' => 'asc'));
	}
}