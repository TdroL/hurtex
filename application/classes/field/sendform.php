<?php defined('SYSPATH') or die('No direct script access.');

class Field_Sendform extends Field_BelongsTo
{
	public function input($prefix = 'jelly/field', $data = array())
	{
		if ( ! isset($data['options']))
		{
			$options = Jelly::select($this->foreign['model'])->execute();

			foreach($options as $v)
			{
				$data['options'][$v->id] = $v->name.' - '.$v->value.' zł';
			}
		}

		return parent::input($prefix, $data);
	}
}
