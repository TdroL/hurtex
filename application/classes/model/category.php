<?php defined('SYSPATH') or die('No direct script access.');

class Model_Category extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->name_key('title')
			->fields(array(
				'id' => new Field_Primary,
				'title' => new Field_String(array(
					'label' => 'Tytuł',
				)),
				'category' => new Field_Category(array(
					'label' => 'Kategoria nadrzędna',
				)),
			));
	}

}