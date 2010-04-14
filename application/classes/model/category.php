<?php defined('SYSPATH') or die('No direct script access.');

class Model_Category extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
				'id' => new Field_Primary,
				'title' => new Field_Text(array(
				)),
				'category' => new Field_BelongsTo(array(
				)),
			));
	}

}