<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Main extends Controller_Frontend
{
	

	public function action_index()
	{
		$this->view->title = 'Produkty';
		$this->content->product = Jelly::select('products')->execute();
		
	}
	
	
}
