<?php defined('SYSPATH') or die('No direct script access.');

class Model_Order extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
				'id' => new Field_Primary,
				'date' => new Field_Timestamp(array(
					'label' => 'Data',
					'pretty_format' => 'Y-m-d H:i:s',
					'default' => time(),
				)),
				'client' => new Field_BelongsTo(array(
					'label' => 'Klient',
				)),
				'status' => new Field_Enum(array(
					'label' => 'Status',
					'default' => 'added',
					'choices' => array(
						'added' => 'Dodane',
						'accepted' => 'Zaakceptowany',
						'sent' => 'Wysłany',
						'canceled' => 'Anulowany',
					),
				)),
				'printed' => new Field_Boolean(array(
					'label' => 'Wydrukowano',
					'default' => 0,
				)),
				'paragon_number' => new Field_String(array(
					'label' => 'Numer paragonu',
					'unique' => TRUE,
				)),
				'invoice' => new Field_String(array(
					'label' => 'Numer faktury',
					'null' => TRUE,
					'unique' => TRUE,
					'callbacks' => array(
						'Model_Order::check_invoice',
					)
				)),
				'payment' => new Field_Enum(array(
					'choices' => array('cash' => 'Gotówka', 'transfer' => 'Przelew'),
				)),
				'sendform' => new Field_Sendform(array(
					'label' => 'Forma wysyłki',
				)),
				'address' => new Field_Text(array(
					'label' => 'Adres alternatywny',
				)),
				'products' => new Field_ManyToMany(array(
					'label' => 'Produkty',
					'through' => 'orderproduct',
				)),
				'orderproducts' => new Field_HasMany(array(
					'label' => 'Produkty',
				)),
			));
	}

	public function generate_paragon_number()
	{
		$this->paragon_number = str_pad(strval($this->id), 10, '0', STR_PAD_LEFT);
		$this->save();
		return $this;
	}

	public function generate_invoice()
	{
		$this->invoice = date('Y/m/d-').$this->id;
		$this->save();
		return $this;
	}
	
	public function cancelable()
	{
		return in_array($this->status, array('added'));
	}

	public function cancel()
	{
		try
		{
			$this->status = 'canceled';
			$this->save();
			
		}
		catch (Validate_Exception $e)
		{
			var_dump($e->errors());
			die();
		}
		return $this;
	}
	
	public function save($key = NULL)
	{
		$status = $this->_original['status'];
		parent::save();
		
		if($status != $this->status and $this->status == 'sent')
		{
			foreach($this->orderproducts as $v)
			{
				$v->product->decrease_quantity($v->quantity);
			}
		}
	}
	
	public function check_invoice(Validate $array, $field)
	{
		var_dump($array, $field);die;
	}
}