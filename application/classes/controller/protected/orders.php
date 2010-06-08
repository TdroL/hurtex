<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_orders extends Controller_Admin
{
	protected $_base = 'admin/orders';
	public $no_template = array('invoice', 'added', 'address','printable');
	
	public $access = array('invoice' => ':controller.index');

	public function action_index()
	{
		$this->content->orders = Jelly::select('order')
									->with('client')
									->page()
									->sort()
									->execute();
								
		$this->content->paginate = new Pagination(array(
			'total_items' => Jelly::select('order')->with('client')->count()
		));
	}
	
	public function action_added()
	{
		$this->content->orders = Jelly::select('order')->with('client')->get_by_status(array('added', 'accepted'))->execute();
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
	
	public function action_details() // przeniesione z kontrolera szczegolow zamowienia dzialu historii zamowien
	{
		$this->content->bind('sum_netto', $sum_netto);
		$this->content->bind('sum_brutto', $sum_brutto);
		$this->content->bind('sum_netto_plus', $sum_netto_plus);
		$this->content->bind('sum_brutto_plus', $sum_brutto_plus);
		
		$id = $this->request->param('id');
		
		$order = Jelly::select('order')
						->with('client')
						->load($id);
						
		
		$this->content->order = $order;
		$this->content->products = $order->orderproducts;
		
		foreach($order->orderproducts as $v)
		{
			$sum_netto += round($v->product->price->value * $v->quantity, 2);
			$sum_brutto += round($v->product->price->value * $v->quantity * (1 + $v->product->price->vat->value), 2);
		}
		
		$sum_netto_plus = $sum_netto + $order->sendform->value;
		$sum_brutto_plus = $sum_brutto + $order->sendform->value;
	}
	
	public function action_invoice()  //przeniesione z account
	{
		$this->content->bind('sum_vat',$sum_vat);//dopisane
		$this->content->bind('sum_netto', $sum_netto);
		$this->content->bind('sum_brutto', $sum_brutto);
		$this->content->bind('sum_netto_plus', $sum_netto_plus);
		$this->content->bind('sum_brutto_plus', $sum_brutto_plus);
		
		$id = $this->request->param('id');
		
		$order = Jelly::select('order')
						->with('client')
						->load($id);
						
		
		$this->content->order = $order;
		$this->content->products = $order->orderproducts;
		
		foreach($order->orderproducts as $v)
		{
			$sum_vat += round($v->product->price->value * $v->quantity * ($v->product->price->vat->value), 2);
			$sum_netto += round($v->product->price->value * $v->quantity, 2);
			$sum_brutto += round($v->product->price->value * $v->quantity * (1 + $v->product->price->vat->value), 2);
		}
		
		$sum_netto_plus = $sum_netto + $order->sendform->value;
		$sum_brutto_plus = $sum_brutto + $order->sendform->value;
	}
	public function action_address() 
	{
		$id = $this->request->param('id');
  
		$this->content->order = Jelly::select('order')
      ->with('client')
      ->load($id);
	}public function action_printable()
	{
		$this->content->bind('sum_netto', $sum_netto);
		$this->content->bind('sum_brutto', $sum_brutto);
		$this->content->bind('sum_netto_plus', $sum_netto_plus);
		$this->content->bind('sum_brutto_plus', $sum_brutto_plus);
		
		$id = $this->request->param('id');
		
		$order = Jelly::select('order')
						->with('client')
						->load($id);
		
		$this->content->order = $order;
		
		$this->content->products = $order->orderproducts;
		
		foreach($order->orderproducts as $v)
		{
			$sum_netto += round($v->product->price->value * $v->quantity, 2);
			$sum_brutto += round($v->product->price->value * $v->quantity * (1 + $v->product->price->vat->value), 2);
		}
		
		$sum_netto_plus = $sum_netto + $order->sendform->value;
		$sum_brutto_plus = $sum_brutto + $order->sendform->value;
	}
	
}
