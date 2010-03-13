<?php defined('SYSPATH') or die('No direct script access.');

class Model_Category extends ORM
{
	protected $_has_many = array('images' => array());
	
	public $_filters = array(
		TRUE => array(
			'trim' => NULL,
		),
		'title'	=> array(
			'html::chars'	=> NULL,
		),
	);
	
	protected $_rules = array(
		'title'	=> array(
			'not_empty'		=> NULL,
		),
		'link' => array(
			'not_empty'		=> NULL,
			'alpha_dash'	=> NULL,
		),
	);
	
	protected $_callbacks = array(
		'link' => array('value_avaible'),
	);
}