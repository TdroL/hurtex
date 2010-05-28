<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Vats extends Controller_Frontend
{
	protected $_base = 'admin/vats';

	public function action_index()
	{
		$this->content->vats = Jelly::select('vat')->execute();
	}

	public function action_create()
	{
		$this->content->bind('form', $vat); // uzywajac bind() widok zapamieta referencje a nie wartosc
		$this->content->bind('errors', $errors); // czyli: jesli zmienimy tutaj wartosc zmiennych $vat 
													// lub $error to bedzie to w widoku te zmienne tez beda zmienione

		$vat = Jelly::factory('vat');

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$vat->set($_POST);
				$vat->value = $vat->value >= 1 ? $vat->value/100 : $vat->value;
				$vat->save();

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
		$this->content->bind('form', $vat);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$vat = Jelly::select('vat', $id);

		if(!$vat->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$vat->set($_POST);
				$vat->value = $vat->value >= 1 ? $vat->value/100 : $vat->value;
				$vat->save();

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
		$this->content->bind('form', $vat);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$vat = Jelly::select('vat', $id);

		if(!$vat->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$vat->delete();

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
