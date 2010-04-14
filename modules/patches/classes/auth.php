<?php defined('SYSPATH') OR die('No direct access allowed.');

abstract class Auth extends Kohana_Auth
{
	protected $_roles = NULL; // array after loading roles
	/*
	public function __construct($config = array())
	{
		parent::__construct($config);
		//echo Kohana::debug($this->logged_in(), Session::instance()->get('auth_user'));
	}
	*/

	protected function _load_roles()
	{
		$this->_roles = array();
		
		if($this->logged_in())
		{
			foreach($this->get_user()->roles as $v)
			{
				$this->_roles[strtolower(trim($v->name))] = TRUE;
			}
		}
	}

	public function has_role($role)
	{
		if(!is_array($this->_roles))
		{
			$this->_load_roles();
		}
		
		return isset($this->_roles['admin']) or $this->has_a_particular_role($role);
	}

	public function has_a_particular_role($role)
	{
		$role = strtolower(trim($role));
		$parent = $role;

		if(strpos($parent, '.') !== FALSE)
		{
			list($parent) = explode('.', $parent, 2);
		}

		return isset($this->_roles[$parent]) or isset($this->_roles[$role]);
	}
}