<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Suppliers extends Controller_Frontend
{
	protected $_base = 'admin/suppliers';

	public function action_index()
	{
		$this->content->suppliers = Jelly::select('supplier')->execute();
	}

	public function action_create()
	{
		$this->content->bind('form', $supplier); // uzywajac bind() widok zapamieta referencje a nie wartosc
		$this->content->bind('errors', $errors); // czyli: jesli zmienimy tutaj wartosc zmiennych $supplier 
													// lub $error to bedzie to w widoku te zmienne tez beda zmienione

		$supplier = Jelly::factory('supplier');

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$supplier->set($_POST);
				$supplier->save();

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
		$this->content->bind('form', $supplier);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$supplier = Jelly::select('supplier', $id);

		if(!$supplier->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			if(empty($_POST['password']))
			{
				unset($_POST['password'], $_POST['password_confirm']);
			}
			
			try
			{
				$supplier->set($_POST);
				$supplier->save();

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
		$this->content->bind('form', $supplier);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$supplier = Jelly::select('supplier', $id);

		if(!$supplier->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$supplier->delete();

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
