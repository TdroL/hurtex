﻿<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Account extends Controller_Frontend
{
	protected $_base = 'account';
	protected $_login = 'account/login';
	
	public $no_view = array('logout');
	
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
		$this->content->from = $this->request->param('from');
		
		if($_POST)
		{
			$client = Jelly::factory('client')->set($_POST);
			
			if($client->login())
			{
				if(!empty($this->content->from))
				{
					$this->request->redirect($this->content->from);
				}
				
				$this->request->redirect($this->_base);
			}
			
			$this->content->error = TRUE;
		}
		
		if(!empty($this->content->from))
		{
			$this->content->from = '/from:'.$this->content->from;
		}
	}
	
	public function action_logout()
	{
		if($this->user)
		{
			$this->user->logout();
			$this->request->redirect($this->_login);
		}
	}
	public function action_update()
	{
		$this->content->bind('form', $client);
		$this->content->bind('errors', $errors);

		$id = 0;
		
		$client = $this->user;
		
		if(!$client)
		{
			$this->request->redirect($this->_login);
		}
		
		unset($client->password);
		
		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			if(empty($_POST['password']))
			{
				unset($_POST['password'], $_POST['password_confirm']);
			}
			
			unset($_POST['email']);
			
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
	public function action_orders_history()
	{
		if(!$this->user)
		{
			$this->request->redirect($this->_login); //sprawdzanie zalogowania
		}
		$this->content->orders = Jelly::select('order')->load_client_orders($this->user->id); // ładowanie zamówien klienta do zmiennej orders
		
	
	}
	public function action_order_details()
	{
		if(!$this->user)
		{
			$this->request->redirect($this->_login); //sprawdzanie zalogowania
		}
		$this->content->orders = Jelly::select('order')->load_client_orders($this->user->id);
	}
}