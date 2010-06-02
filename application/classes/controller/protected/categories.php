<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_categories extends Controller_Admin
{
	protected $_base = 'admin/categories';

	public function action_index()
	{
		$this->content->categories = Jelly::select('category')
										->page()
										->sort()
										->execute();
		
		$this->content->paginate = new Pagination(array(
			'total_items' => Jelly::select('category')->count()
		));
	}

	public function action_create()
	{
		$this->content->bind('form', $category); // uzywajac bind() widok zapamieta referencje a nie wartosc
		$this->content->bind('errors', $errors); // czyli: jesli zmienimy tutaj wartosc zmiennych $category 
													// lub $error to bedzie to w widoku te zmienne tez beda zmienione

		$category = Jelly::factory('category');

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$category->set($_POST);
				
				$category->save();

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
		$this->content->bind('form', $category);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$category = Jelly::select('category', $id);

		if(!$category->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			if($_POST['category'] == $category->id)
			{
				unset($_POST['category']);
			}
			
			try
			{
				$category->set($_POST);
				$category->value = $category->value >= 1 ? $category->value/100 : $category->value;
				$category->save();

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
		$this->content->bind('form', $category);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$category = Jelly::select('category', $id);

		if(!$category->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$category->delete();

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
