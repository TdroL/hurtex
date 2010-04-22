<?php defined('SYSPATH') or die('No direct script access.');

class Model_Client extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
				'id' => new Field_Primary,
				'first_name' => new Field_String(array(
					'label' => 'Imię',
					'rules' => array(
						'not_empty' => NULL,
						'alpha' => NULL,
					),
				)),
				'second_name' => new Field_String(array(
					'label' => 'Nazwisko',
					'rules' => array(
						'not_empty' => NULL,
						'alpha' => NULL,
					),
				)),
				'email' => new Field_Email(array(
					'label' => 'E-mail',
					'unique' => TRUE,
					'rules' => array(
						'not_empty' => NULL,
						'matches' => array('email_confirm'),
					),
				)) ,
				'email_confirm' => new Field_Email(array(
					'label' => 'Powtórz e-mail',
					'in_db' => FALSE,
				)) ,
				'password' => new Field_Password(array(
					'label' => 'Hasło',
					'rules' => array(
						'not_empty' => NULL,
						'matches' => array('password_confirm'),
					),
				)),
				 'password_confirm' => new Field_Password(array(
					'label' => 'Powtórz hasło',
					'in_db' => FALSE,
				)),
				'address' => new Field_Text(array(
					'label' => 'Adres',
					'rules' => array(
						'not_empty' => NULL,
					),
				)),
				'phone_number' => new Field_String(array(
					'label' => 'Numer telefonu',
					'rules' => array(
						'not_empty' => NULL,
						'phone' => NULL,
					),
				)),
				'company_name' => new Field_String(array(
					'label' => 'Nazwa firmy',
				)),
				'nip' => new Field_Integer(array(
					'label' => 'NIP',
					'unique' => TRUE,
					'rules' => array(
						'digit' => NULL,
					),
				)),
			));
	}

}