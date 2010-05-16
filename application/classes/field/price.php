<?php defined('SYSPATH') or die('No direct script access.');

class Field_Price extends Field_BelongsTo
{
	public function save($model, $value, $loaded)
	{
		if($model->price->changed())
		{
			$values = array(
				'value' => $model->price->value,
				'vat' => $model->price->vat,
			);
			
			$price = Jelly::factory('price')->set($values)->save();
			
			$value = $price->id;
			$model->_late_update[] = array($price, 'product', 'id');
		}
		
		return $value;
	}
}
