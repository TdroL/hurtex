<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Clients extends Controller_Frontend
{
	protected $_base = 'admin/clients';

	public function action_index()
	{
		$this->content->clients = Jelly::select('client')->execute();
	}

	public function action_create()
	{
		$this->content->bind('form', $client); // uzywajac bind() widok zapamieta referencje a nie wartosc
		$this->content->bind('errors', $errors); // czyli: jesli zmienimy tutaj wartosc zmiennych $client 
													// lub $error to bedzie to w widoku te zmienne tez beda zmienione

		$client = Jelly::factory('client');

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$client->set($_POST);
				$client->save();

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
		$this->content->bind('form', $client);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$client = Jelly::select('client', $id);

		if(!$client->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		unset($client->password);

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			if(empty($_POST['password']))
			{
				unset($_POST['password'], $_POST['password_confirm']);
			}
			
			if(empty($_POST['email_confirm']))
			{
				unset($_POST['email'], $_POST['email_confirm']);
			}
			
			try
			{
				$client->set($_POST);
				$client->save();

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
		$this->content->bind('form', $client);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$client = Jelly::select('client', $id);

		if(!$client->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$client->delete();

				$this->session->set($_POST['seed'], TRUE);
				$this->request->redirect($this->_base);
			}
			catch(Validate_Exception $e)
			{
				$errors = $e->errors();
			}
		}
	}
	
	public function action_details()
	{
		$this->content->bind('form', $client);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$this->content->client = Jelly::select('client', $id);

		if(!$this->content->client->loaded()) // jesli ine istnieje to przekieruj do listy klientów
		{
			$this->request->redirect($this->_base);
		}
	}
}
