<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Categories extends Controller_Auth
{
	protected $_index = 'admin/categories';
	
	public function action_index()
	{
		$this->content->categories = ORM('category')->with('image')->find_all();
	}
	
	public function action_create()
	{
		$this->content->bind('post', $post);
		$this->content->bind('errors', $errors);

		$post = new FormFields($_POST);
		
		if(!empty($_POST) and !$this->session->get($_POST['sand'], FALSE))
		{
			$orm = ORM('category')->validate($_POST);
			if($orm->check())
			{
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

		$id = $this->param('id');
		$orm = ORM('category')->find($id);

		if(!$orm->loaded())
		{
			$this->request->redirect($this->_index);
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
		$orm = ORM('category')->with('image')->find($id);

		if(!$orm->loaded())
		{
			$this->request->redirect($this->_index);
		}

		$post = new FormFields($orm);
		$post->id = $id;
		$post->images = $orm->images;

		if(!empty($_POST) and !$this->session->get($_POST['sand'], FALSE))
		{
			$images = array();

			foreach($orm->images->find_all() as $v)
			{
				$images[] = trim($v->image, '/');
				$images[] = trim($v->thumb, '/');
			}

			$orm->delete();

			$base = DOCROOT.'media/images/';
			foreach($images as $k => $v)
			{
				$file = $base.$v;

				if(!empty($v) and file_exists($file) and !is_dir($file))
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