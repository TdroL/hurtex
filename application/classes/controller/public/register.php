<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Register extends Controller_Template
{
		
 
public function action_register()
	{
		$this->content->bind('clients', $client);
		$this->content->bind('errors', $errors);

		$client = Jelly::factory('client');

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$client->set($_POST);
				$client->save();

				$this->session->set($_POST['seed'], TRUE);
				/*$this->request->redirect($this->_base);*/
			}
			catch(Validate_Exception $e)
			{
				$errors = $e->errors();
			}
		}
	}
}