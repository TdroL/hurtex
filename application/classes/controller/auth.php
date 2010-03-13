<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller_Template
{
	public $access = array();
	public $auth = NULL;
	
	public function before()
	{
		parent::before();
		$this->auth = Auth::instance();
		
		$role = $this->request->controller; // default role
		$action = $this->request->action;
		
		if(array_key_exists($action, $this->access)) // for only this one action
		{
			$role = $this->access[$action];
		}
		else if(in_array(TRUE, array_keys($this->access))) // for all actions
		{
			$role = $this->access[TRUE];
		}
		
		if(empty($role))
		{
			return; // if $role is NULL, FALSE (empty) allow for all users, even not logged
		}
		
		if($this->auth->logged_in())
		{
			if(!defined('ADMIN_LOGGED') and $this->auth->has_role('admin'))
			{
				define('ADMIN_LOGGED', TRUE);
			}
			
			if(!$this->auth->has_role($role))
			{
				// role required: $role
				$this->request->redirect('admin/main');
			}

			is_object($this->view) and $this->view->bind_global('auth', $this->auth);
		}
		else
		{
			// not logged in
			$this->request->redirect('admin/login');
		}
	}
}