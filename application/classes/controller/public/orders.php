<?php

class Controller_Public_Orders extends Controller_Frontend
{
	protected $_base = 'orders';
	protected $_home = '';

	public function action_details()
	{
		if(!$this->user)
		{
			$this->request->redirect($this->_home);
		}
		
		$id = $this->request->param('id');
		
		$order = Jelly::select('order')
						->with('client')
						->load($id);
		
		if(!$order->loaded() or $order->client->id == $this->user->id)
		{
			$this->request->redirect($this->_home);
		}
		
		$this->content->order = $order;
	}

}
