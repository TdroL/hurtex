<?php defined('SYSPATH') or die('No direct script access.');

class Model_Order extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
				'id' => new Field_Primary,
				'date' => new Field_Timestamp(array(
					'pretty_format' => 'Y-m-d H:i:s',
					'default' => time(),
				)),
				'client' => new Field_BelongsTo(array(
				)),
				'status' => new Field_Enum(array(
					'choices' => array('added', 'accepted', 'send', 'canceled'),
				)),
				'printed' => new Field_Boolean(array(
				)),
				'paragon_number' => new Field_String(array(
				)),
				'invoice' => new Field_String(array(
				)),
				'address' => new Field_BelongsTo(array(
				)),
				'payment' => new Field_Enum(array(
					'choices' => array('cach', 'transfer'),
				)),
				'send_form' => new Field_BelongsTo(array(
					'foreign' => 'sendform',
				)),
				'products' => new Field_ManyToMany(array(
				)),
			));
	}

}