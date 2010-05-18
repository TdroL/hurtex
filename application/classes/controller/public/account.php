<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Account extends Controller_Frontend
{
	protected $_base = 'account';
	
	public function action_index()
	{
		
	}
	
	public function action_create()
	{
		$this->content->bind('client', $client);
		$this->content->bind('errors', $errors);

		$client = Jelly::factory('client');

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$client->set($_POST);
				$client->save();

				$this->session->set($_POST['seed'], TRUE);
				
				// $this->force_login($client);
				$this->request->redirect($this->_base);
			}
			catch(Validate_Exception $e)
			{
				$errors = $e->errors();
			}
		}
	}
	
	public function action_login()
	{
		if($_POST)
		{
			$client = Jelly::factory('client')->set($_POST);
			
			if($client->login())
			{
				$this->request->redirect($this->_base);
			}
			
			$this->content->error = TRUE;
		}
	}
	
	public function action_logout()
	{
		if($this->user)
		{
			$this->user->logout();
			$this->request->redirect($this->_base);
		}
	}
}