<?php defined('SYSPATH') or die('No direct script access.');

class Model_Builder_Product extends Jelly_Builder
{
	public function belongs_to_category($id)
	{
		$ids = Jelly::select('category')->load_childs_ids((int) $id);
		return $this->with('category')->where('category', 'IN', $ids);
	}
	
	public function load_search($query)
	{
		return $this->select('product_search.product_id', DB::expr('(MATCH (product_search.name, product_search.full_data) AGAINST ('.Database::instance()->escape($query).' IN BOOLEAN MODE)) as score'))
				->join('product_search', 'INNER')
				->on(':primary_key', '=', DB::expr('product_search.product_id'))
				->where(DB::expr('MATCH(product_search.name, product_search.full_data)'), 'AGAINST', DB::expr('('.Database::instance()->escape($query).' IN BOOLEAN MODE)'))
				->order_by('score', 'DESC')
				->execute();
	}
	
	public function load_by_ids(array $ids)
	{
		if(empty($ids))
		{
			$ids = array(0);
		}
		return $this->where(':primary_key', 'IN', $ids)->execute();
	}
	
	public function sort()
	{
		$sort = Request::instance()->param('sort', 'quantity');
		$order = Request::instance()->param('order');
		
		if($sort == 'quantity')
		{
			return $this->select('*', array(DB::expr('(quantity/minimal_quantity)'), 'sorting_row'))->order_by('sorting_row', $order);
		}
		
		return parent::sort();
	}
	
	public function get_deficient()
	{
		return $this->and_where_open()
						->where(DB::expr('(products.quantity - products.minimal_quantity)'), '<=', 0)
						->or_where('products.quantity', '=', 0)
					->and_where_close();
	}
}