<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Main extends Controller_Template
{
	public function action_index()
	{
		$this->content->products = Jelly::select('product')->execute();
		$this->content->form = Jelly::factory('product');
	}
}