<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Users extends Controller_Admin
{
	protected $_base = 'admin/users';
	protected $_home = 'admin';
	
	public $access = array(
						'login' => NULL,
						'logout' => NULL,
						'restricted' => NULL,
					);
					
	public $no_template = array('login');
	public $no_view = array('logout');
	
	public function action_login()
	{
		$this->content->bind('error', $error);
		
		if($_POST)
		{
			if($this->auth->login($_POST['username'], $_POST['password']))
			{
				$this->request->redirect($this->_home);
			}
			else
			{
				$error = TRUE;
			}
		}
	}
	
	public function action_restricted()
	{
		
	}
	
	public function action_logout()
	{
		$this->auth->logout();
		$this->request->redirect($this->_base);
	}
	
	public function action_index()
	{
		$this->content->users = Jelly::select('user')->execute();
	}
	
	public function action_create()
	{
		$this->content->bind('form', $user); // uzywajac bind() widok zapamieta referencje a nie wartosc
		$this->content->bind('errors', $errors); // czyli: jesli zmienimy tutaj wartosc zmiennych $user 
													// lub $error to bedzie to w widoku te zmienne tez beda zmienione

		$user = Jelly::factory('user');

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$user->set($_POST);
				$user->save();
				
				if($user->rolesgroup)
				{
					$user->roles = $user->rolesgroup->roles;
					$user->save();
				}
				
				$this->session->set($_POST['seed'], TRUE); // 'seed' jest zintegrowany w formularz
				$this->request->redirect($this->_base);
			}
			catch(Validate_Exception $e)
			{
				$errors = $e->errors();
			}
		}
	}

	public function action_update()
	{
		$this->content->bind('form', $user);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$user = Jelly::select('user', $id);

		if(!$user->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		unset($user->password);

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			if(empty($_POST['password']))
			{
				unset($_POST['password'], $_POST['password_confirm']);
			}
			
			try
			{
				$user->set($_POST);
				$user->save();

				if($user->rolesgroup)
				{
					$user->roles = $user->rolesgroup->roles;
					$user->save();
				}

				$this->session->set($_POST['seed'], TRUE); // 'seed' jest zintegrowany w formularz
				$this->request->redirect($this->_base);
			}
			catch(Validate_Exception $e)
			{
				$errors = $e->errors();
			}
		}
	}

	public function action_delete()
	{
		$this->content->bind('form', $user);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$user = Jelly::select('user', $id);

		if(!$user->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$user->delete();

				$this->session->set($_POST['seed'], TRUE);
				$this->request->redirect($this->_base);
			}
			catch(Validate_Exception $e)
			{
				$errors = $e->errors();
			}
		}
	}
}