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
					'choices' => array(
						'added' => 'Dodany',
						'accepted' => 'Zaakceptowany',
						'send' => 'Wysłany',
						'canceled' => 'Anulowany',
					),
				)),
				'printed' => new Field_Boolean(array(
					'label' => 'Wydrukowano',
				)),
				'paragon_number' => new Field_String(array(
					'label' => 'Numer paragonu',
				)),
				'invoice' => new Field_String(array(
					'label' => 'Numer faktury',
					'unique' => TRUE,
				)),
				'payment' => new Field_Enum(array(
					'choices' => array('cach', 'transfer'),
				)),
				'send_form' => new Field_BelongsTo(array(
					'foreign' => 'sendform',
				)),
				'address' => new Field_String(array(
					'label' => 'Adres alternatywny',
				)),
				'products' => new Field_ManyToMany(array(
					'label' => 'Produkty',
				)),
			));
	}

}