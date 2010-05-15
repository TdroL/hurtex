<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Template extends Controller_Template
{
	

	public function action_template()
	{
		
		$this->content->categories = Jelly::select('category')->execute();
	}
	
}