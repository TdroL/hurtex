<?php 

abstract class Controller_Frontend extends Controller_Template
{
	public $user = NULL;
	
	function before()
	{
		parent::before();
		
		$this->user = $this->session->get('client', NULL);
		
		if($this->view instanceof View)
		{
			$this->view->set_global('user', $this->user);
		}
	}
}

