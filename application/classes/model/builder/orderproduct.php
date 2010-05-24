<?php defined('SYSPATH') or die('No direct script access.');

class Model_Builder_OrderProduct extends Jelly_Builder
{
	public function load_products_orders($id)
	{
		return $this->with('product')
					->with('price')
					->where('order_id', '=', $id)
					->execute();
	}
}