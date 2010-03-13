<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Images extends Controller_Template
{
	public function action_index()
	{
		$category = $this->param('category');
		$page = $this->param('page');
		$limit = 3;
		$page--;
		$page < 0 and $page = 0;

		if(!empty($category))
		{
			$category = ORM('category', array('link' => $category));
			if($category->loaded())
			{
				$this->content->images = $category->images
												->limit($limit)
												->offset($page*$limit)
												->order_by('date', 'desc')
												->find_all()
												->as_array();
												
				$count = $category->images->count_all();
				
				$this->content->pagination = new Pagination(array(
						'total_items'    => $count,
						'items_per_page' => $limit,
						'view'           => 'pagination/arrows',
						'auto_hide'      => FALSE,
				));
				
				$this->content->pagination_bottom = new Pagination(array(
						'total_items'    => $count,
						'items_per_page' => $limit,
						'view'           => 'pagination/bottom',
				));
			}
		}
		else
		{
			$this->content->images = ORM('image')
											->limit($limit)
											->offset($page*$limit)
											->order_by('date', 'desc')
											->find_all()
											->as_array();

			$count = ORM('image')->count_all();

			$this->content->pagination = new Pagination(array(
					'total_items'    => $count,
					'items_per_page' => $limit,
					'view'           => 'pagination/arrows',
					'auto_hide'      => FALSE,
			));
			
			$this->content->pagination_bottom = new Pagination(array(
					'total_items'    => $count,
					'items_per_page' => $limit,
					'view'           => 'pagination/bottom',
			));
		}
	}
}