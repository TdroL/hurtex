<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Products extends Controller_Admin
{
	protected $_base = 'admin/products';
	
	public $access = array('details' => ':controller.index');
	public $no_template = array('address');
	public function action_index()
	{
		$this->content->products = Jelly::select('product')
										->page()
										->sort()
										->execute();
		
		$this->content->paginate = new Pagination(array(
			'total_items' => Jelly::select('product')->count()
		));
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
				$product->set($_FILES);
				$product->save();

				$this->session->set($_POST['seed'], TRUE); // 'seed' jest zintegrowany w formularz
				$this->request->redirect($this->_base);
			}
			catch(Validate_Exception $e)
			{
				$product->current_image = $product->image;
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
		
		$product->current_image = $product->image;

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$product->set($_POST);
				$product->set($_FILES);
				
				if(empty($product->image['name']))
				{
					unset($product->image);
				}
				
				$product->save();

				$this->session->set($_POST['seed'], TRUE); // 'seed' jest zintegrowany w formularz
				$this->request->redirect($this->_base);
			}
			catch(Validate_Exception $e)
			{
				$product->current_image = $product->image;
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
	public function action_details() //przeniesione z public products controler 
	{
		$id = $this->request->param('id');
		
		$product = Jelly::select('product')->load($id);

		if(!$product->loaded())
		{
			$this->request->redirect($this->_base);
			// mozna albo to albo jakas strone z informacja "Brak takiego produktu"
		}
		
		$this->view->title = $product->name;
		$this->content->product = $product;
	}
	public function action_address() 
	{
		$this->action_details;
	}
}
