<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Warehouse extends Controller_Admin
{
	protected $_base = 'admin/warehouse';
	protected $_home = 'admin';

	public $no_template = array('deficient', 'supply');

	public function action_index()
	{
		$this->content->products = Jelly::select('product')
										->page()
										->sort()
										->execute();
	
		$this->content->paginate = new Pagination(array(
			'total_items' => Jelly::select('product')->count(),
		));
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
	
	public function action_deficient()
	{
		$this->content->products = Jelly::select('product')->get_deficient()->execute();
	}
}

