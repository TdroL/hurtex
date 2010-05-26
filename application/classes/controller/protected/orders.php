<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_orders extends Controller_Template
{
	protected $_base = 'admin/orders';

	public function action_index()
	{
		$this->content->orders = Jelly::select('order')->with('client')->execute();
	}
	
	public function action_create()
	{
		$this->content->bind('form', $order); // uzywajac bind() widok zapamieta referencje a nie wartosc
		$this->content->bind('errors', $errors); // czyli: jesli zmienimy tutaj wartosc zmiennych $order 
													// lub $error to bedzie to w widoku te zmienne tez beda zmienione

		$order = Jelly::factory('order');
		
		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$order->set($_POST);
				$order->set($_FILES);
				$order->save();

				$this->session->set($_POST['seed'], TRUE); // 'seed' jest zintegrowany w formularz
				$this->request->redirect($this->_base);
			}
			catch(Validate_Exception $e)
			{
				$order->current_image = $order->image;
				$errors = $e->errors();
			}
		}
	}
	
	public function action_update()
	{
		$this->content->bind('form', $order);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$order = Jelly::select('order', $id);

		if(!$order->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$order->set($_POST);				
				$order->save();

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
		$this->content->bind('form', $order);
		$this->content->bind('errors', $errors);

		$id = $this->request->param('id');
		$order = Jelly::select('order', $id);

		if(!$order->loaded()) // jesli ine istnieje to przekieruj do listy produktow
		{
			$this->request->redirect($this->_base);
		}

		if($_POST and !$this->session->get($_POST['seed'], FALSE))
		{
			try
			{
				$order->delete();

				$this->session->set($_POST['seed'], TRUE);
				$this->request->redirect($this->_base);
			}
			catch(Validate_Exception $e)
			{
				$errors = $e->errors();
			}
		}
	}
	public function action_details() // przeniesione z kontrolera szczegolow zamowienia dzialu historii zamowien
	{
		$this->content->bind('sum_netto', $sum_netto);
		$this->content->bind('sum_brutto', $sum_brutto);
		$this->content->bind('sum_netto_plus', $sum_netto_plus);
		$this->content->bind('sum_brutto_plus', $sum_brutto_plus);

		/*if(!$this->user)
		{
			$this->request->redirect($this->_base);
		}*/
		
		$id = $this->request->param('id');
		
		$order = Jelly::select('order')
						->with('client')
						->load($id);
						
		
		/*if(!$order->loaded() or $order->client->id != $this->user->id)
		{
			$this->request->redirect($this->_base);
		}*/
		
		$this->content->order = $order;
		
		$products = Jelly::select('orderproduct')->load_products_orders($order->id);
		$this->content->products = $products;
		
		foreach($products as $v)
		{
			$sum_netto += round($v->product->price->value * $v->quantity, 2);
			$sum_brutto += round($v->product->price->value * $v->quantity * (1 + $v->product->price->vat->value), 2);
		}
		
		$sum_netto_plus = $sum_netto + $order->sendform->value;
		$sum_brutto_plus = $sum_brutto + $order->sendform->value;
	}
}
