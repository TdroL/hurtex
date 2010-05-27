<?php defined('SYSPATH') or die('No direct script access.');

class Model_Builder_Order extends Jelly_Builder
{
	public function load_client_orders($id)
	{
		return $this->select('*', array(DB::expr('(SELECT COUNT(*) FROM orders_products WHERE orders_products.order_id = orders.id)'), 'count_products'))->where('client_id', '=', $id)->execute();
	}
	
	public function get_added()
	{
		return $this->where('status', '=', 'added');
	}
}