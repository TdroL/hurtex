<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Sendforms extends Controller_Admin
{
	protected $_base = 'admin/sendforms';

	public function action_index()
	{
		$this->content->sendforms = Jelly::select('sendform')->execute();
	}

	public function action_create()
	{
		$this->content->bind('form', $sendform); // uzywajac bind() widok zapamieta referencje a nie wartosc
		$this->content->bind('errors', $errors); // czyli: jesli zmienimy tutaj wartosc zmiennych $sendform 
													// lub $error to bedzie to w widoku te zmienne tez beda zmienione

		$sendform = Jelly::factory('sendform');

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$sendform->set($_POST);
				$sendform->save();

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
		$this->content->bind('form', $sendform);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$sendform = Jelly::select('sendform', $id);

		if(!$sendform->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$sendform->set($_POST);
				$sendform->save();

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
		$this->content->bind('form', $sendform);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$sendform = Jelly::select('sendform', $id);

		if(!$sendform->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$sendform->delete();

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
