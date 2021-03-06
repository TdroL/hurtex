<?php defined('SYSPATH') or die('No direct script access.');

class Field_Category extends Field_BelongsTo
{
	protected $no_root = FALSE;
	protected $list = array();
	protected $parent = array();
	protected $dash = '&nbsp;&nbsp;&nbsp;';
	
	public function input($prefix = 'jelly/field', $data = array())
	{
		if ( ! isset($data['options']))
		{
			$options = Jelly::select($this->foreign['model'])
				->execute()
				->as_array();

				foreach($options as $v)
				{
					$this->list[$v['id']] = $v;
					if($v['category'] !== NULL)
					{
						$this->parent[$v['category']][] = $v['id'];
					}
				}

				$data['options'] = $this->view_category(1);
				
				if($this->no_root)
				{
					unset($data['options'][1]);
				}
		}

		return parent::input($prefix, $data);
	}
	
	protected function view_category($id = 1, $t = NULL)
	{
		if(!isset($this->list[$id]))
		{
			return array();
		}
	
		$result = array();
		
		$tmp = $this->list[$id];
		
		$result[$tmp['id']] = trim($t.' '.$tmp['title']);
		
		if(array_key_exists($tmp['id'], $this->parent))
		{
			foreach($this->parent[$tmp['id']] as $v)
			{
				$result = arr::merge($result, $this->view_category($v, $t.$this->dash));
			}
		}
		
		return $result;
	}
}
