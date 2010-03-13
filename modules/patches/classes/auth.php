<?php defined('SYSPATH') OR die('No direct access allowed.');

abstract class Auth extends Kohana_Auth
{
	protected $_logged = FALSE;
	protected $_roles = array();
	protected $_user = array();
	
	public function __construct($config = array())
	{
		parent::__construct($config);
		$this->_logged = $this->logged_in();

		if(!$this->logged)
		{
			$this->auto_login();
			$this->_logged = $this->logged_in();
		}

		if($this->_logged)
		{
			$this->_user = $this->get_user();
			foreach($this->_user->roles->find_all() as $v)
			{
				$this->_roles[$v->name] = TRUE;
			}
		}
	}
	
	public function has_role($role, $check_admin = TRUE)
	{
		// if $check_admin is TRUE then check if user is an admin even if he/she hasn't that role
		return (isset($this->_roles[$role]) or ($check_admin and isset($this->_roles['admin'])));
	}
	
	public function __get($key)
	{
		if(is_object($this->_user))
		{
			return $this->_user->{$key};
		}
	}
}