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
						'added' => 'Dodany',
						'accepted' => 'Zaakceptowany',
						'send' => 'Wysłany',
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
					'unique' => TRUE,
				)),
				'payment' => new Field_Enum(array(
					'choices' => array('cash' => 'Gotówka', 'transfer' => 'Przelew'),
				)),
				'sendform' => new Field_Sendform(array(
				)),
				'address' => new Field_Text(array(
					'label' => 'Adres alternatywny',
				)),
				'products' => new Field_ManyToMany(array(
					'label' => 'Produkty',
				)),
			));
	}

	public function generate_paragon_number()
	{
		$this->paragon_number = (string) $this->id;
		$this->paragon_number = str_pad($this->paragon_number, '0', 10 - strlen($this->paragon_number), STR_PAD_LEFT);
		$this->save();
		return $this;
	}

	public function generate_invoice()
	{
		$this->invoice = date('Y/m/d-').$this->id;
		$this->save();
		return $this;
	}
}