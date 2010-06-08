<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Supplies extends Controller_Admin
{
	protected $_base = 'admin/supplies';
	
	public function action_index()
	{
		$this->content->supplies = Jelly::select('supply')
										->page()
										->sort()
										->execute();
		
		$this->content->paginate = new Pagination(array(
			'total_items' => Jelly::select('supply')->count(),
		));
	}
	
	public function action_details()
	{
		$id = $this->request->param('id');
		$supply = Jelly::select('supply', $id);
		$supply->set('product', $supply->product); // bez tego nie dziala, lol

		if(!$supply->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}
		
		$this->content->supply = $supply;
	}
	
	public function action_create()
	{
		$this->content->bind('form', $supply); // uzywajac bind() widok zapamieta referencje a nie wartosc
		$this->content->bind('suppliers', $suppliers);
		$this->content->bind('errors', $errors); // czyli: jesli zmienimy tutaj wartosc zmiennych $supply 
													// lub $error to bedzie to w widoku te zmienne tez beda zmienione

		$supply = Jelly::factory('supply');
		
		$id = $this->request->param('id');
		$supply->product = Jelly::select('product', $id);

		if(!$supply->product->loaded())
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$supply->set($_POST);
				$supply->save();

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
		$this->content->bind('form', $supply);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$supply = Jelly::select('supply', $id);
		$supply->set('product', $supply->product); // bez tego nie dziala, lol

		if(!$supply->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			if(in_array($supply->status, array('done')))
			{
				unset($_POST['status']);
			}
			
			if(!in_array($supply->status, array('added')))
			{
				unset($_POST['quantity'], $_POST['supplier']);
			}
			
			try
			{
				$supply->set($_POST);
				$supply->save();

				$this->session->set($_POST['seed'], TRUE); // 'seed' jest zintegrowany w formularz
				$this->request->redirect($this->_base);
			}
			catch(Validate_Exception $e)
			{
				$errors = $e->errors();
			}
		}
	}
}
