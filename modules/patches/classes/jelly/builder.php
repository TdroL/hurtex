<?php defined('SYSPATH') or die('No direct script access.');

class Jelly_Builder extends Jelly_Builder_Core
{
	protected function _column($field, $join = TRUE, $value = NULL)
	{
		if(!is_string($field))
		{
			return $field;
		}
		
		return parent::_column($field, $join, $value);
	}
	
	public function page($page = NULL, $items = 25)
	{
		$page = Request::instance()->param('page');
		$page = --$page < 0 ? 0 : $page;
		return $this->limit($items)->offset($page*$items);
	}
	
	public function sort()
	{
		$sort = Request::instance()->param('sort');
		$order = Request::instance()->param('order');
		
		if(empty($sort))
		{
			return $this;
		}
		return $this->order_by($sort, $order);
	}
	
	public function loaded()
	{
		return !empty($this->_result);
	}
}