<?php defined('SYSPATH') or die('No direct script access.');

class Model_ProductOrder extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->table('products_orders')
			->fields(array(
				'id' => new Field_Primary,
				'product' => new Field_BelongsTo(array(
					'label' => 'Produkt',
				)),
				'price' => new Field_BelongsTo(array(
					'label' => 'Cena',
				)),
				'order' => new Field_BelongsTo(array(
					'label' => 'Zamówienie',
				)),
				'quantity' => new Field_Float(array(
					'label' => 'Ilość',
					'default' => 0,
				)),
			));
	}

}