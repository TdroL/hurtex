<?php defined('SYSPATH') or die('No direct script access.');

class Model_Product extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
				'id' => new Field_Primary,
				'name' => new Field_String(array(
				)),
				'description' => new Field_Text(array(
				)),
				'category' => new Field_BelongsTo(array(
				)),
				'unit' => new Field_BelongsTo(array(
				)),
				'quantity' => new Field_Float(array(
				)),
				'minimal_quantity' => new Field_Float(array(
				)),
				'price' => new Field_BelongsTo(array(
				)),
				'orders' => new Field_ManyToMany(array(
				)),
				'suppliers' => new Field_ManyToMany(array(
				)),
				'supplies' => new Field_ManyToMany(array(
				)),
			));
	}

}