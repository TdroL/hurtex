<?php defined('SYSPATH') or die('No direct script access.');

class Model_Builder_Category extends Jelly_Builder
{
	public function load_as_tree()
	{
		$categories = $this->select('*', array('category_id', 'parent'))->order_by('title', 'ASC')->execute();
		$tree = array();
			
		foreach ($categories as $k => $v)
		{
			if($v->id != 1)
			{
				$parent = $v->get('parent');
				$parent = empty($parent) ? 1 : $parent;
				$tree[$parent][] = $v;
			}
		}
		
		return $tree;
	}
	
	public function load_childs_ids($id)
	{
		$this->_ids = array($id => $id);
		$this->_tree = $this->load_as_tree();
		
		if(!empty($this->_tree[$id]))
		{		
			$this->_find_ids($this->_tree[$id]);
		}

		return $this->_ids;
	}
	
	/* --- local methods --- */
	
	protected $_ids = array();
	protected $_tree = array();	
	protected function _find_ids($value)
	{
		if($value instanceof Model_Category)
		{
			$this->_ids[$value->id] = $value->id;

			if(!empty($this->_tree[$value->id]))
			{
				$this->_find_ids($this->_tree[$value->id]);
			}
		}
		else if(is_array($value))
		{
			foreach ($value as $v)
			{
				$this->_find_ids($v);
			}
		}
	}
}