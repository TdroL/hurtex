<?php 

class Controller_Public_Cart extends Controller_Template
{
	protected $_base = 'cart';
	
	public $no_view = array('add');

	public function action_index()
	{
		$this->content->bind('quantity', $quantity);
		// [id] => [quantity]
		// 1 => 2
		$cart = $this->session->get('cart_products', array());
		$ids = array_keys($cart);
		$quantity = $cart;
		
		$this->content->products = Jelly::select('product')->load_by_ids($ids);
		
		if($_POST)
		{
			// edytowano koszyk
		}
	}

	public function action_add()
	{
		$id = $this->request->param('id');
		
		$cart = $this->session->get('cart_products', array());
		
		if(empty($cart[$id]))
		{
			if(Jelly::select('product')->exists($id))
			{
				$cart[$id] = 1;
				$this->session->set('cart_products', $cart);
			}
		}
		
		$this->request->redirect($this->_base);
	}
}