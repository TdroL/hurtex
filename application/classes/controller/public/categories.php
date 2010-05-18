<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Categories extends Controller_Frontend
{
	public $no_template = array('index');

	public function action_index()
	{
		$this->content->tree = Jelly::select('category')->load_as_tree();
		$this->content->parent = 0; // najwyzsza kategoria ("Brak") [root]
	}
	
}