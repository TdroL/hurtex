<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_RolesGroups extends Controller_Admin
{
	protected $_base = 'admin/rolesgroups';
	
	public $access = array(TRUE => 'admin');
	
	
	public function action_index()
	{
		$this->content->rolesgroups = Jelly::select('rolesgroup')->execute();
	}
	
	public function action_create()
	{
		$this->content->bind('form', $rolesgroup); // uzywajac bind() widok zapamieta referencje a nie wartosc
		$this->content->bind('errors', $errors); // czyli: jesli zmienimy tutaj wartosc zmiennych $rolesgroup 
													// lub $error to bedzie to w widoku te zmienne tez beda zmienione

		$rolesgroup = Jelly::factory('rolesgroup');

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$rolesgroup->set($_POST);
				$rolesgroup->save();

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
		$this->content->bind('form', $rolesgroup);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$rolesgroup = Jelly::select('rolesgroup', $id);

		if(!$rolesgroup->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		unset($rolesgroup->password);

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			if(empty($_POST['password']))
			{
				unset($_POST['password'], $_POST['password_confirm']);
			}
			
			try
			{
				$rolesgroup->set($_POST);
				$rolesgroup->save();

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
		$this->content->bind('form', $rolesgroup);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$rolesgroup = Jelly::select('rolesgroup', $id);

		if(!$rolesgroup->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$rolesgroup->delete();

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
