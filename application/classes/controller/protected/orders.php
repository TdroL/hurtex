<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_orders extends Controller_Template
{
	protected $_base = 'admin/orders';

	public function action_index()
	{
		$this->content->orders = Jelly::select('order')->with('client')->execute();
	}
	
	public function action_create()
	{
		$this->content->bind('form', $order); // uzywajac bind() widok zapamieta referencje a nie wartosc
		$this->content->bind('errors', $errors); // czyli: jesli zmienimy tutaj wartosc zmiennych $order 
													// lub $error to bedzie to w widoku te zmienne tez beda zmienione

		$order = Jelly::factory('order');
		
		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$order->set($_POST);
				$order->set($_FILES);
				$order->save();

				$this->session->set($_POST['seed'], TRUE); // 'seed' jest zintegrowany w formularz
				$this->request->redirect($this->_base);
			}
			catch(Validate_Exception $e)
			{
				$order->current_image = $order->image;
				$errors = $e->errors();
			}
		}
	}
	
	public function action_update()
	{
		$this->content->bind('form', $order);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$order = Jelly::select('order', $id);

		if(!$order->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}
		
		$order->current_image = $order->image;

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$order->set($_POST);
				$order->set($_FILES);
				
				if(empty($order->image['name']))
				{
					unset($order->image);
				}
				
				$order->save();

				$this->session->set($_POST['seed'], TRUE); // 'seed' jest zintegrowany w formularz
				$this->request->redirect($this->_base);
			}
			catch(Validate_Exception $e)
			{
				$order->current_image = $order->image;
				$errors = $e->errors();
			}
		}
	}
	
	public function action_delete()
	{
		$this->content->bind('form', $order);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$order = Jelly::select('order', $id);

		if(!$order->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$order->delete();

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
