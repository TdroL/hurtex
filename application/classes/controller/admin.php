<?php
class Controller_Admin extends Controller_Auth
{
	public $redirect_url = 'admin/users/restricted';
	public $login_url = 'admin/users/login';
	public $company;
	
	function before()
	{
		parent::before();
		
		$this->company = Kohana::config('company');
		
		if($this->view instanceof View)
		{
			$this->view->bind_global('company', $this->company);
		}
	}
}