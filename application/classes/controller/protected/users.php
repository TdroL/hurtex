<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Users extends Controller_Auth
{
	protected $_index = 'admin/users';

	public $access = array(
			'last' => 'login',
			TRUE => 'admin',
	);
	
	public $no_template = array('last');
	public $no_view = array('deactivate', 'activate');
	
	public function action_index()
	{
		define('STATUS_USER', 0);
		define('STATUS_ADMIN', 1);
		define('STATUS_INACTIVE', 2);

		$this->content->field = $this->param('field', 'nick');
		$this->content->sort = $this->param('sort', 'desc');

		$this->content->users = ORM('user')->with('roles')->order_by($this->content->field, $this->content->sort)->find_all();
		$this->content->admin = ORM('role', array('name' => 'admin'));
		$this->content->login = ORM('role', array('name' => 'login'));
	}
	
	public function action_create()
	{
		$this->content->bind('post', $post);
		$this->content->bind('errors', $errors);
		$this->content->roles = ORM('role')->find_all();
		
		$post = new FormFields($_POST);

		if(!empty($_POST) and !$this->session->get($_POST['sand'], FALSE))
		{
			DB::begin();
			$orm = ORM('user')->validate($_POST);
			if($orm->check())
			{
				try
				{
					$orm->save();

					if(!empty($_POST['roles'])) foreach($_POST['roles'] as $k => $v)
					{
						$orm->add('roles', ORM('role', array('name' => $v)));
					}

					DB::commit();
					
					$this->session->set($_POST['sand'], TRUE);
					$this->request->redirect($this->_index);
				}
				catch(Exception $e)
				{
					DB::rollback();
					$orm->error('server', 'internal_error', array($e->getMessage()));
				}
			}
			//else, catch
			$errors = $orm->errors('validate');
			$post->set($orm);
		}
	}
	
	public function action_update()
	{
		$this->content->bind('post', $post);
		$this->content->bind('errors', $errors);
		$this->content->roles = ORM('role')->find_all();

		$id = $this->param('id');
		$orm = ORM('user')->with('role')->find($id);

		if(!$orm->loaded())
		{
			$this->request->redirect($this->_index);
		}

		$post = new FormFields($_POST);
		$post->id = $id;

		if(!empty($_POST) and !$this->session->get($_POST['sand'], FALSE))
		{
			$orm->validate($_POST, array('password', 'password_confirm'));
			if($orm->check())
			{
				$orm->save();
				
				if(!empty($_POST['roles']))
				{
					foreach($_POST['roles'] as $k => $v)
					{
						$role = ORM('role', array('name' => $v));
						if(!$orm->has('roles', $role))
						{
							$orm->add('roles', $role);
						}
					}
					
					foreach($orm->roles->find_all() as $v)
					{
						if(!isset($_POST['roles'][$v->name]))
						{
							$orm->remove('roles', $v);
						}
					}
				}

				$this->session->set($_POST['sand'], TRUE);
				$this->request->redirect($this->_index);
			}
			//else
			$errors = $orm->errors('validate');
			$post->set($orm);
		}
		else
		{
			$post->set($orm);
			
			$roles = array();
			foreach($orm->roles->find_all() as $v)
			{
				$roles[$v->name] = $v->name;
			}
			
			$post->roles = $roles; // notice :/
		}
	}
	
	public function action_delete()
	{
		$this->content->bind('post', $post);
		$this->content->bind('errors', $errors);

		$id = $this->param('id');
		$orm = ORM('user')->find($id);

		if(!$orm->loaded() or $id == $this->auth->id or ORM('user')->count_all() < 2)
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
	
	public function action_password()
	{
		$this->content->bind('post', $post);
		$this->content->bind('errors', $errors);
		$this->content->roles = ORM('role')->find_all();

		$id = $this->param('id');
		$orm = ORM('user')->find($id);

		if(!$orm->loaded())
		{
			$this->request->redirect($this->_index);
		}

		$post = new FormFields($orm);
		$post->id = $id;

		if(!empty($_POST) and !$this->session->get($_POST['sand'], FALSE))
		{
			$orm->validate($_POST, array('username', 'nick', 'email'));
			if($orm->check())
			{
				$orm->save();

				$this->session->set($_POST['sand'], TRUE);
				$this->request->redirect($this->_index);
			}
			//else
			$errors = $orm->errors('validate');
		}
	}
	
	public function action_deactivate()
	{
		$id = $this->param('id');
		$orm = ORM('user')->find($id);
		$role = ORM('role', array('name' => 'login'));//->find();
		
		if($orm->loaded() and $orm->has('roles', $role))
		{
			$orm->remove('roles', $role);
		}

		$this->request->redirect($this->_index);
	}
	
	public function action_activate()
	{
		$id = $this->param('id');
		$orm = ORM('user')->find($id);
		$role = ORM('role', array('name' => 'login'));//->find();

		if($orm->loaded() and !$orm->has('roles', $role))
		{
			$orm->add('roles', $role);
		}

		$this->request->redirect($this->_index);
	}
	
	public function action_last()
	{
		$this->content->users = ORM('user')->order_by('last_login', 'desc')->find_all();
	}
}
