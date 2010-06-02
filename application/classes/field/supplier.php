<?php defined('SYSPATH') or die('No direct script access.');

class Field_Supplier extends Field_BelongsTo
{
	public $product;
	
	public function attach($product)
	{
		$this->product = $product;
	}
	
	public function input($prefix = 'jelly/field', $data = array())
	{
		if ( ! isset($data['options']))
		{
			$data['options'] = Jelly::select($this->foreign['model'])
				->join('products_suppliers', 'LEFT')
				->on('products_suppliers.supplier_id', '=', $this->foreign['model'].':primary_key')
				->where('products_suppliers.product_id', '=', $this->product->id)
				->execute()
				->as_array($this->foreign['model'].':primary_key', $this->foreign['model'].':name_key');
		}

		return parent::input($prefix, $data);
	}
}
