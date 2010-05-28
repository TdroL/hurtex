<?php
class Controller_Admin extends Controller_Auth
{
	public function before()
	{
		parent::before();
		
		$this->company = Kohana::config('company');
		
		if($this->view instanceof View)
		{
			$this->view->set_global('user', $this->user);
			$this->view->bind_global('company', $this->company);
		}
	}
}