<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Pages extends Controller_Auth
{
	protected $_index = 'admin/pages';
	
	public function action_index()
	{
		$this->content->field = $this->param('field', 'date');
		$this->content->sort = $this->param('sort', 'desc');

		$this->content->pages = ORM('page')
									->order_by($this->content->field, $this->content->sort)
									->find_all();
	}
	
	public function action_create()
	{
		$this->content->bind('post', $post);
		$this->content->bind('errors', $errors);

		$post = new FormFields($_POST);

		if(!empty($_POST) and !$this->session->get($_POST['sand'], FALSE))
		{
			$orm = ORM('page')->validate($_POST);
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

		$id = $this->param('id');
		$orm = ORM('page')->find($id);

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
		$orm = ORM('page')->find($id);

		if(!$orm->loaded())
		{
			$this->request->redirect($this->_index);
		}

		$post = new FormFields($orm);
		$post->id = $id;

		if(!empty($_POST) and !$this->session->get($_POST['sand'], FALSE))
		{
			$orm->delete();

			$this->session->set($_POST['sand'], TRUE);
			$this->request->redirect($this->_index);
		}
	}
}
