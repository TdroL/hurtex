<?php defined('SYSPATH') or die('No direct script access.');

class Model_Client extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
				'id' => new Field_Primary,
				'first_name' => new Field_String(array(
				)),
				'second_name' => new Field_String(array(
				)),
				'email' => new Field_String(array(
				)) ,
				'password' => new Field_String(array(
				)),
				'address' => new Field_Text(array(
				)),
				'phone_number' => new Field_String(array(
				)),
				'company_name' => new Field_String(array(
				)),
				'nip' => new Field_Integer(array(
				)),
			));
	}

}