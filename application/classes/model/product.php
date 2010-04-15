<?php defined('SYSPATH') or die('No direct script access.');

class Model_Product extends Jelly_Model
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
				'description' => new Field_Text(array(
					'label' => 'Opis',
					'rules' => array(
						'not_empty' => NULL,
					),
				)),
				'category' => new Field_BelongsTo(array(
					'label' => 'Kategoria',
				)),
				'unit' => new Field_BelongsTo(array(
					'label' => 'Jednostka miary',
				)),
				'quantity' => new Field_Float(array(
					'label' => 'Ilość',
				)),
				'minimal_quantity' => new Field_Float(array(
					'label' => 'Minimalna ilość',
				)),
				'price' => new Field_BelongsTo(array(
					'label' => 'Cena',
				)),
				'orders' => new Field_ManyToMany(array(
				)),
				'suppliers' => new Field_ManyToMany(array(
				)),
				'supplies' => new Field_ManyToMany(array(
				)),
			))
			->load_with(array('price'));
	}

}