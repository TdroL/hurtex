<?php defined('SYSPATH') or die('No direct script access.');

class Model_Builder_Order extends Jelly_Builder
{
	public function load_clients_orders($id)
	{
		return $this->where('client_id', '=', $id)->execute();
	}
}