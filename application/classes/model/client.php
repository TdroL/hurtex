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
					),
				)),
				'second_name' => new Field_String(array(
					'label' => 'Nazwisko',
					'rules' => array(
						'not_empty' => NULL,
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
						'min_length' => array(4),
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
						'phone' => array(array(9, 11)),
					),
				)),
				'company_name' => new Field_String(array(
					'label' => 'Nazwa firmy',
				)),
				'nip' => new Field_String(array(
					'label' => 'NIP',
					'unique' => TRUE,
					'null' => TRUE,
					'filters' => array(
						'Model_Client::prepare_nip' => NULL,
					),
					'rules' => array(
						'nip' => NULL,
					),
				)),
			))
			->sorting(array('second_name' => 'asc'));
	}
	
	public function login()
	{
		$client = Jelly::select('client')->where('email', '=', $this->email)->limit(1)->execute();
		
		if(!$client->loaded())
		{
			return FALSE;
		}
		
		if(($client->password == call_user_func($this->_meta->fields('password')->hash_with, $this->password)))
		{
			Session::instance()->set('client', $client);
			return TRUE;
		}
		
		return FALSE;
	}
	
	public function logout()
	{
		Session::instance()->delete('client');
	}
	
	public function logged_in()
	{
		return Session::instance()->get('client', NULL);
	}
	
	public static function prepare_nip($value)
	{
		return preg_replace('/\D/i', NULL, $value);
	}
}