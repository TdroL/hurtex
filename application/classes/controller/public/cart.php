<?php 

class Controller_Public_Cart extends Controller_Frontend
{
	protected $_base = 'cart';
	protected $_confirm = 'cart/confirm';
	
	public $no_view = array('add', 'remove');

	public function action_index()
	{
		$this->content->bind('quantity', $cart);
		// [id] => [quantity]
		// 1 => 2
		$cart = $this->session->get('cart_products', array());
		
		if($_POST)
		{
			foreach($_POST['product'] as $k => $v)
			{
				$cart[$k] = number_format($v, 2);
				
				var_dump($cart[$k]);
				
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
		$this->content->products = Jelly::select('product')->load_by_ids($ids);
		
		if(!empty($cart))
		{
			$changed = FALSE;
			foreach($this->content->products as $v)
			{
				var_dump($cart[$v->id]);
				if($cart[$v->id] > $v->quantity)
				{
					$cart[$v->id] = $v->quantity;
					$changed = TRUE;
				}
			}
			
			if($changed)
			{
				$this->session->set('cart_products', $cart);
			}
		}
	}

	public function action_order()
	{
		$this->content->bind('quantity', $quantity);
		$this->content->bind('sum_netto', $sum_netto);
		$this->content->bind('sum_brutto', $sum_brutto);

		$cart = $this->session->get('cart_products', array());
		
		$ids = array_keys($cart);
		$quantity = $cart;
		$this->content->products = Jelly::select('product')->load_by_ids($ids);
		
		$sum_netto = 0;
		$sum_brutto = 0;
		
		foreach($this->content->products as $k => $v)
		{
			$sum_netto += round($v->price->value*$quantity[$v->id], 2);
			$sum_brutto += round($v->price->value*$quantity[$v->id] * (1 + $v->price->vat->value), 2);
		}
		$order = Jelly::factory('order')
				->set($this->session->get('order_details', array()));
		
		if($_POST)
		{
			if(isset($_POST['back-step-cart']))
			{
				$this->request->redirect($this->_base);
			}
			else if(isset($_POST['next-step-1']))
			{
				$this->session->set('order_details', $_POST);
				
				if(!$this->user)
				{
					$this->request->redirect('account/login/from:cart/order');
				}
				
				$order->set($_POST);
				
				if(empty($_POST['address']))
				{
					$order->address = $this->user->address;
				}
				
				$this->content->set_filename('public/cart/confirm');
				$sum_netto += $order->sendform->value;
				$sum_brutto += $order->sendform->value;
			}
			else if(isset($_POST['next-step-2']))
			{
				
			}
			
			$this->session->set('order_details', $_POST);
		}
		
		$this->content->order = $order;
	}

	public function action_add()
	{
		$id = $this->request->param('id');
		
		$cart = $this->session->get('cart_products', array());
		
		if(empty($cart[$id]))
		{
			$product = Jelly::select('product', $id);
			if($product->loaded() and $product->quantity > 0)
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