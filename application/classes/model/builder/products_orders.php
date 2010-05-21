<?php defined('SYSPATH') or die('No direct script access.');

class Model_Builder_Products_Orders extends Jelly_Builder
{
	public function load_products_orders($id)
	{
		return $this->where('order_id', '=', $id)->execute();
	}
}