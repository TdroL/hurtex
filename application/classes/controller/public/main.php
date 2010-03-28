<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Main extends Controller_Template
{
	public function action_index()
	{
		$this->content->products = ORM('product')
									->limit(2)
									->offset(3)
									->find_all();
		// hello!
	}
}