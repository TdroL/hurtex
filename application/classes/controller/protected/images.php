<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Images extends Controller_Auth
{
	protected $_index = 'admin/images';

	public function action_index()
	{
		$this->content->field = $this->param('field', 'date');
		$this->content->sort = $this->param('sort', 'desc');
		$this->content->categories = ORM('category')->find_all();
		
		$page = $this->param('page') - 1;
		$page < 1 and $page = 0;
		$limit = 20;
		
		$only = $this->param('category', FALSE);
		$this->content->category = $only;
		
		$orm = ORM('image')->with('category');
		
		if(!empty($only))
		{
			$orm->where('category.link', '=', $only);
		}
		
		$count = clone $orm;

		$this->content->images = $orm->offset($page*$limit)
								->limit($limit)
								->order_by($this->content->field, $this->content->sort)
								->find_all();
		
		$this->content->pagination = new Pagination(array(
			'total_items'    => $count->count_all(),
			'items_per_page' => $limit,
		));
	}
	
	public function action_create()
	{
		$this->content->bind('post', $post);
		$this->content->bind('errors', $errors);
		$this->content->categories = ORM('category')->find_all();
		
		$post = new FormFields($_POST);
		
		if(!empty($_POST) and !$this->session->get($_POST['sand'], FALSE))
		{
			$orm = ORM('image')->validate($_POST);
			
			if($orm->check())
			{
				$orm->date = time();
				$orm->save();
				
				$this->session->set($_POST['sand'], TRUE);
				$this->request->redirect($this->_index);
			}
			//else
			$errors = $orm->errors('validate');
			$post->set($orm);
		}
	}
	
	public function action_update()
	{
		$this->content->bind('post', $post);
		$this->content->bind('errors', $errors);
		$this->content->categories = ORM('category')->find_all();

		$id = $this->param('id');
		$orm = ORM('image')->find($id);

		if(!$orm->loaded())
		{
			$this->request->redirect($this->_index); // invalid id
		}

		$post = new FormFields($_POST);
		$post->id = $id;

		if(!empty($_POST) and !$this->session->get($_POST['sand'], FALSE))
		{
			$orm->validate($_POST);
			if($orm->check())
			{
				$orm->save();
				
				$this->session->set($_POST['sand'], TRUE);
				$this->request->redirect($this->_index);
			}
			//else
			$errors = $orm->errors('validate');
		}
		
		$post->set($orm);
	}
	
	public function action_delete()
	{
		$this->content->bind('post', $post);
		$this->content->bind('errors', $errors);

		$id = $this->param('id');
		$orm = ORM('image')->with('category')->find($id);

		if(!$orm->loaded())
		{
			$this->request->redirect($this->_index);
		}

		$post = new FormFields($orm);
		$post->id = $id;

		if(!empty($_POST) and !$this->session->get($_POST['sand'], FALSE))
		{
			$images = array($orm->image, $orm->thumb);

			$orm->delete();

			$base = DOCROOT.'media/images/';
			foreach($images as $v)
			{
				$file = $base.$v;

				if(file_exists($file))
				{
					$count = (int) ORM('image')
							->where('image', '=', $v)
							->or_where('thumb', '=', $v)
							->count_all();
					if($count == 0)
					{
						@unlink($file);
					}
				}
			}
			
			$this->session->set($_POST['sand'], TRUE);
			$this->request->redirect($this->_index);
		}
	}
}