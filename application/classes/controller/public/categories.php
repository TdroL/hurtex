<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Categories extends Controller_Template
{
	

	public function action_index()
	{
		
		$this->content->categories = Jelly::select('category')->execute();
	}