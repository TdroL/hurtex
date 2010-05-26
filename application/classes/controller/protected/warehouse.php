<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Warehouse extends Controller_Frontend
{
	protected $_base = 'warehouse';
	protected $_home = '';

	public $no_template = array('deficient');

	public function action_index()
	{
		$this->content->products = Jelly::select('product')->sort_by_quantity()->execute();
	}
	
	public function action_deficient()
	{
		$this->content->products = Jelly::select('product')->get_deficient()->execute();
	}
	
	public function action_supply()
	{
		$this->content->products = Jelly::select('supply')->execute();
	}
}

