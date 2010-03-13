<?php defined('SYSPATH') or die('No direct script access.');

class Model_Page extends ORM
{
	public $_filters = array(
		'title'	=> array(
			'html::chars'	=> NULL,
			'trim'			=> NULL,
		),
		'link' => array(
			'trim'			=> NULL,
		),
	);

	protected $_rules = array(
		'title' => array(
			'not_empty'		=> NULL,
		),
		'link' => array(
			'not_empty'		=> NULL,
			'alpha_dash'	=> NULL,
		),
		'content' => array(
			'not_empty'		=> NULL,
		),
	);
	
	protected $_callbacks = array(
		'link' => array('value_avaible'),
	);
}