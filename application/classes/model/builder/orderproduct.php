<?php defined('SYSPATH') or die('No direct script access.');

class Model_Builder_OrderProduct extends Jelly_Builder
{
	public function get_span($start, $end)
	{
		return $this->with('order')
					->where('date', '>=', (int) $start)
					->where('date', '<=', (int) $end)
					->where('status', '=', 'sent');
	}
}
