<?php 

abstract class Controller_Frontend extends Controller_Template
{
	public $user = NULL;
	public $company;
	
	function before()
	{
		parent::before();
		
		$this->user = $this->session->get('client', NULL);
		$this->company = Kohana::config('company');
		
		if($this->view instanceof View)
		{
			$this->view->set_global('user', $this->user);
			$this->view->bind_global('company', $this->company);
		}
	}
}

