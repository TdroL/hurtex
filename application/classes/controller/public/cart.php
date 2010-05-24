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
		$this->content->bind('quantity', $cart);
		$this->content->bind('sum_netto', $sum_netto);
		$this->content->bind('sum_brutto', $sum_brutto);
		$this->content->bind('sum_netto_plus', $sum_netto_plus);
		$this->content->bind('sum_brutto_plus', $sum_brutto_plus);

		$cart = $this->session->get('cart_products', array());
		
		$ids = array_keys($cart);
		$this->content->products = Jelly::select('product')->load_by_ids($ids);
		
		$sum_netto = 0;
		$sum_brutto = 0;
		
		foreach($this->content->products as $k => $v)
		{
			$sum_netto += round($v->price->value*$cart[$v->id], 2);
			$sum_brutto += round($v->price->value*$cart[$v->id] * (1 + $v->price->vat->value), 2);
		}
		$order = Jelly::factory('order')
				->set($this->session->get('order_details', array()));
		
		if($_POST and !empty($cart))
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
				$sum_netto_plus = $sum_netto + $order->sendform->value;
				$sum_brutto_plus = $sum_brutto + $order->sendform->value;
			}
			else if(isset($_POST['next-step-2']) and ($order_details = $this->session->get('order_details')))
			{
				$ids = array_keys($cart);
				
				if(empty($order_details['address']))
				{
					$order->address = $this->user->address;
				}
				
				$order->client = $this->user;
				
				try
				{
					DB::begin();
					
					$order->save();
					
					if($order->invoice)
					{
						$order->generate_invoice();
					}
					else
					{
						$order->invoice = NULL;
					}
					
					$order->generate_paragon_number();
					
					foreach($cart as $k => $v)
					{
						
						$product = Jelly::select('product', $k);
						
						$relation = Jelly::factory('orderproduct');
						
						$relation->order = $order;
						$relation->product = $product;
						$relation->price = $product->price->id;
						$relation->quantity = $v;
						
						$relation->save();
						//$product->decrease_quantity($v);
					}
					
					DB::commit();
					
					$this->session->delete('cart_products');
					$this->session->delete('order_details');
					
					$this->request->redirect('account/history');
				}
				catch (Exception $e)
				{
					echo Kohana::debug($e);
					die('blad');
					DB::rollback();
				}
				
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