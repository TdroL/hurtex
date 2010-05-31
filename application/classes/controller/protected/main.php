<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Main extends Controller_Admin
{
	public $access = array(TRUE => 'login');
	
	public function action_index()
	{
		
	}
}
