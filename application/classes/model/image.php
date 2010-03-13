<?php defined('SYSPATH') or die('No direct script access.');

class Model_Image extends ORM
{
	protected $_belongs_to = array('category' => array());
	
	public $_filters = array(
		TRUE => array(
			'trim' => NULL,
		),
		'title'	=> array(
			'html::chars'	=> NULL,
		),
	);
	
	protected $_rules = array(
		TRUE => array(
			'trim' => NULL,
		),
		'title'	=> array(
			'not_empty'		=> NULL,
		),
		'category_id' => array(
			'not_empty'		=> NULL,
		),
	);
	
	protected $_callbacks = array(
		'category_id'	=> array('category_exists'),
		'thumb_action'	=> array('image_upload'),
		'image_action'	=> array('image_upload'),
	);
	
	protected $_upload = array(
		'thumb' => array(
				'folder' => 'web/small/',
		),
		'image' => array(
				'folder' => 'web/big/',
		)
	);

	public function order_by($field, $order = 'asc')
	{
		$field == 'category' and $field = 'category.title';
		
		$order = strtolower($order);
		$order != 'asc' and $order = 'desc';
		
		return parent::order_by($field, $order);
	}

	public function category_exists(Validate $array, $field)
	{
		$category = ORM('category')->find($array[$field]);
		if(!$category->loaded($array[$field]))
		{
			$array->error($field, 'category_exists');
			return FALSE;
		}
		
		return TRUE;
	}

	public function override(FormFields $post)
	{
		parent::override($post);
		
		if($post->_validate === NULL)
		{
			$post->thumb_action = 'actual';
			$post->thumb_actual = $post->thumb;
			
			$post->image_action = 'actual';
			$post->image_actual = $post->image;
		}
	}
}