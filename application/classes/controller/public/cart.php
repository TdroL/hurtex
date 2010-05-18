<?php 

class Controller_Public_Cart extends Controller_Template
{
	protected $_base = 'cart';
	
	public $no_view = array('add', 'remove');

	public function action_index()
	{
		$this->content->bind('quantity', $quantity);
		// [id] => [quantity]
		// 1 => 2
		$cart = $this->session->get('cart_products', array());
		
		if($_POST)
		{
			foreach($_POST['product'] as $k => $v)
			{
				$cart[$k] = number_format($v, 2);
				
				if((double) $v <= 0)
				{
					unset($cart[$k]);
				}
			}
			
			$this->session->set('cart_products', $cart);
			
			if(isset($_POST['order']))
			{
				$this->request->redirect('cart/order');
			}
		}
		
		$ids = array_keys($cart);
		$quantity = $cart;
		$this->content->products = Jelly::select('product')->load_by_ids($ids);
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
	
	public function action_remove()
	{
		$id = $this->request->param('id');
		
		$cart = $this->session->get('cart_products', array());
		
		unset($cart[$id]);
		
		$this->session->set('cart_products', $cart);
		
		$this->request->redirect($this->_base);
	}
}