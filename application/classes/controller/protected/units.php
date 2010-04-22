<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_units extends Controller_Template
{
	protected $_base = 'admin/units';

	public function action_index()
	{
		$this->content->units = Jelly::select('unit')->execute();
	}

	public function action_create()
	{
		$this->content->bind('form', $unit); // uzywajac bind() widok zapamieta referencje a nie wartosc
		$this->content->bind('errors', $errors); // czyli: jesli zmienimy tutaj wartosc zmiennych $unit 
													// lub $error to bedzie to w widoku te zmienne tez beda zmienione

		$unit = Jelly::factory('unit');

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$unit->set($_POST);
				
				//echo Kohana::debug($unit);die;
				
				$unit->save();

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
		$this->content->bind('form', $unit);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$unit = Jelly::select('unit', $id);

		if(!$unit->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$unit->set($_POST);
				$unit->value = $unit->value >= 1 ? $unit->value/100 : $unit->value;
				$unit->save();

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
		$this->content->bind('form', $unit);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$unit = Jelly::select('unit', $id);

		if(!$unit->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$unit->delete();

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
