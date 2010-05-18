<?php 

class Controller_Frontend extends Controller_Template
{
	public $user = NULL;
	
	function before()
	{
		parent::before();
		
		$this->user = $this->session->get('client', NULL);
		
		if($this->view !== NULL)
		{
			$this->view->set_global('user', $this->user);
		}
	}
}

