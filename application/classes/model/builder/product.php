<?php defined('SYSPATH') or die('No direct script access.');

class Model_Builder_Product extends Jelly_Builder
{
	public function belongs_to_category($id)
	{
		$ids = Jelly::select('category')->load_childs_ids((int) $id);
		return $this->where('category', 'IN', $ids);
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
}