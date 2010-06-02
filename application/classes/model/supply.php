<?php defined('SYSPATH') or die('No direct script access.');

class Model_Supply extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
				'id' => new Field_Primary,
				'date' => new Field_Timestamp(array(
					'label' => 'Data',
					'default' => time(),
				)),
				'status' => new Field_Enum(array(
					'label' => 'Status',
					'default' => 'added',
					'choices' => array(
								'added' => 'Dodany',
								'in-progress' => 'W trakcie',
								'done' => 'Zakończony',
								'canceled' => 'Anulowany',
					),
				)),
				'product' => new Field_BelongsTo(array(
					'label' => 'Produkt',
				)),
				'supplier' => new Field_Supplier(array(
					'label' => 'Dostawca',
				)),
				'quantity' => new Field_Float(array(
					'label' => 'Ilość',
					'default' => 0,
					'rules' => array(
						'not_empty' => NULL,
					),
				)),
			))
			->load_with(array('product', 'supplier'))
			->sorting(array('date' => 'desc'));
	}

	public function set($values, $value = NULL)
	{
		if($values == 'product')
		{
			$this->_meta->fields('supplier')->product = $value;
		}
		return parent::set($values, $value);
	}
	
	public function save($key = NULL)
	{
		if($this->product->unit->type == 'integer')
		{
			$this->quantity = (int) $this->quantity;
		}
		
		$status = $this->_original['status'];
		parent::save();
		
		if($status != $this->status and $this->status == 'done')
		{
			$this->product->modify_quantity($this->quantity);
		}
	}
}