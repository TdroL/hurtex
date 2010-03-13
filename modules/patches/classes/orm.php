<?php defined('SYSPATH') or die('No direct script access.');

class ORM extends Kohana_ORM 
{
	protected $_upload = array();
	protected $_upload_default = array( // upload default params
		'base'		=> 'media/images/',
		'replace'	=> TRUE,
		'folder'	=> NULL,
	);

	public function override(FormFields $post)
	{
		if($this->_validate !== NULL)
		{
			$post->set($this->_validate->as_array());
		}
		else
		{
			$post->set($this->_object);
			
			foreach($this->_related as $k => $v)
			{
				$post->{$k} = new FormFields;
				$v->override($post->{$k});
			}
		}
	}
	
	public function validate($values, array $ignore_fields = array())
	{
		if(empty($this->_labels))
		{
			$this->_labels = Kohana::message('fields');
		}
		
		$this->_validate = Validate::factory($values);

		foreach ($this->_rules as $field => $rules)
		{
			if(!in_array($field, $ignore_fields))
			{
				$this->_validate->rules($field, $rules);
			}
		}

		foreach ($this->_filters as $field => $filters)
		{
			if(!in_array($field, $ignore_fields))
			{
				$this->_validate->filters($field, $filters);
			}
		}

		foreach ($this->_labels as $field => $label)
		{
			if(!in_array($field, $ignore_fields))
			{
				$this->_validate->label($field, $label);
			}
		}

		foreach ($this->_callbacks as $field => $callbacks)
		{
			if(!in_array($field, $ignore_fields))
			{
				foreach ($callbacks as $callback)
				{
					if (is_string($callback) AND method_exists($this, $callback))
					{
						// Callback method exists in current ORM model
						$this->_validate->callback($field, array($this, $callback));
					}
					else
					{
						// Try global function
						$this->_validate->callback($field, $callback);
					}
				}
			}
		}
		
		return $this;
	}
	
	public function check()
	{
		if($this->_validate instanceof Validate and $this->_validate->check())
		{
			$this->values($this->_validate->as_array());
			return TRUE;
		}
		return FALSE;
	}
	
	public function errors($messages = NULL)
	{
		return $this->_validate->errors($messages);
	}
	
	public function error($field, $message, $params = array())
	{
		return $this->_validate->error($field, $message, $params);
	}

	// -------------------------------------------------------------------
	// -------------------------------------------------------------------
	// -------------------------------------------------------------------

	public function value_avaible(Validate $array, $field)
	{
		$query = $this->where($field, '=', $array[$field]);

		if($this->id > 0)
		{
			$query->where('id', '!=', $this->id);
		}

		if($query->count_all() > 0)
		{
			$array->error($field, 'unique');
			return FALSE;
		}
		return TRUE;
	}

	public function image_upload(Validate $array, $field)
	{
		$action = $array[$field];

		$name = utf8::str_ireplace('_action', '', $field);

		$params = isset($this->_upload[$name]) ? $this->_upload[$name] : array();

		$params = arr::overwrite($this->_upload_default, $params);
		$path = DOCROOT.rtrim($params['base'], '\\/').'/';
		$params['folder'] = rtrim($params['folder'], '\\/').'/';
		$folder = $path.$params['folder'];

		if(!is_dir($folder))
		{
			$array->error($name, 'is_dir', array($folder));
			return FALSE;
		}
		
		switch($action)
		{
			case 'actual':
			{
				$file = $array[$name.'_actual'];
				if(!file_exists($path.$file))
				{
					$array->error($name, 'missing_file', array($file));
					return FALSE;
				}

				$array[$name] = $array[$name.'_actual'];
				break;
			}

			case 'new':
			default:
			{
				$validate = Validate::factory($_FILES);
				$validate->labels(Kohana::message('fields'));
				$validate->rules($name.'_new', array(
							'Upload::valid'		=> array(),
							'Upload::not_empty'	=> array(),
							'Upload::type'		=> array('Upload::type' => array('jpg','png','gif')), 
				));

				if ($validate->check())
				{
					//ok
					if(!$params['replace'] and file_exists($path.$_FILES[$name.'_new']['name']))
					{
						$array->error($name, 'file_exists', array($_FILES[$name.'_new']['name']));
						return FALSE;
					}

					if(empty($array[$name.'_actual']) or !file_exists($path.$array[$name.'_actual']) or md5_file($path.$array[$name.'_actual']) != md5_file($_FILES[$name.'_new']['tmp_name'])) // if not the same file
					{
						$file = Upload::save($_FILES[$name.'_new'], $_FILES[$name.'_new']['name'], $folder);
						
						if(!empty($array[$name.'_actual']) and $array[$name.'_actual'] != $params['folder'].basename($file) and file_exists($path.$array[$name.'_actual']))
						{
							unlink($path.$array[$name.'_actual']);
						}

						$array[$name.'_actual'] = $params['folder'].basename($file);
					}
					else
					{
						//var_dump('md5_file', file_exists($path.$array[$name.'_actual']));
					}

					$array[$name] = $array[$name.'_actual'];
					$array[$field] = 'actual';
				}
				else
				{
					//error
					$errors = $validate->errors();
					if(isset($errors[$name.'_new']))
					{
						$array->error($name, $errors[$name.'_new'][0], $errors[$name.'_new'][1]);
						return FALSE;
					}
				}

				break;
			}
		}

		return TRUE;
	}
}