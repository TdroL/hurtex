<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Products extends Controller_Template
{
	protected $_base = 'admin/products';

	public function action_index()
	{
		$this->content->products = Jelly::select('product')->execute();
	}
	
	public function action_create()
	{
		$this->content->bind('form', $product); // uzywajac bind() widok zapamieta referencje a nie wartosc
		$this->content->bind('errors', $errors); // czyli: jesli zmienimy tutaj wartosc zmiennych $product 
													// lub $error to bedzie to w widoku te zmienne tez beda zmienione

		$product = Jelly::factory('product');
		
		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$product->set($_POST);
				$product->save();

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
		$this->content->bind('form', $product);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$product = Jelly::select('product', $id);

		if(!$product->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$product->set($_POST);
				$product->save();

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
		$this->content->bind('form', $product);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$product = Jelly::select('product', $id);

		if(!$product->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$product->delete();

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
