<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Products extends Controller_Frontend
{
	protected $_base = 'products'; // zmienna przechowujaca adres glowny modulu, uzywany przez redirecty

	public function action_index()
	{
		$this->view->title = 'Produkty';
		
		$page = $this->request->param('page') - 1;
		
		$this->content->products = Jelly::select('product')->with('category')->page($page)->execute();
		$this->content->pagination = new Pagination(array(
				'total_items' => Jelly::select('product')->count(),
		));
	}
	
	public function action_details()
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
	
	public function action_search()
	{
		$this->view->bind_global('query', $query);
		
		if(isset($_POST['query']))
		{
			$query = $_POST['query'];
			$this->content->products = Jelly::select('product')->load_search($query);
		}
	}
	
	public function action_category()
	{
		$id = $this->request->param('id');
		$page = $this->request->param('page') - 1;
		
		$this->view->title = Jelly::select('category', $id)->title;
		$this->content->products = Jelly::select('product')->belongs_to_category($id)->page($page)->execute();
		$this->content->pagination = new Pagination(array(
				'total_items' => Jelly::select('product')->belongs_to_category($id)->count(),
		));
	}
}
