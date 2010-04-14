<?php defined('SYSPATH') or die('No direct script access.');

class Model_Price extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->name_key('value')
			->fields(array(
				'id' => new Field_Primary,
				'product' => new Field_BelongsTo(array(
				)),
				'value' => new Field_Float(array(
					'column' => 'price',
				)),
				'date' => new Field_Timestamp(array(
				)),
				'vat' => new Field_BelongsTo(array(
				)),
			));
	}

}