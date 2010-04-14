<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Auth extends Controller_Template
{
	public $access = array();
	public $redirect_url = 'users/restricted';
	public $login_url = 'users/login';
	public $auth = NULL;
	
	public function before()
	{
		parent::before();
		$this->auth = Auth::instance();
		
		if(is_object($this->view))
		{
			$this->view->bind_global('auth', $this->auth);
		}
		
		$role = $this->request->controller; // default role
		$action = $this->request->action;
		
		if(array_key_exists($action, $this->access)) // for only this one action
		{
			$role = $this->access[$action];
		}
		else if(isset($this->access[TRUE])) // for all actions
		{
			$role = $this->access[TRUE];
		}
		
		if(empty($role))
		{
			return; // if $role is NULL, FALSE (empty) allow for all users, even not logged
		}
		
		if($this->auth->logged_in())
		{
			if(!$this->auth->has_role($role.'.'.$action)) // custom method
			{
				// role required: $role
				$this->request->redirect($this->redirect_url);
			}
			// else: passed - allowed to action
		}
		else
		{
			// not logged in
			$this->session->set('referrer', Request::instance()->uri());
			$this->request->redirect($this->login_url);
		}
	}
}