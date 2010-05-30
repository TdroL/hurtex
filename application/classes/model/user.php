<?php defined('SYSPATH') or die ('No direct script access.');

class Model_User extends Model_Auth_User
{
	public static function initialize(Jelly_Meta $meta)
    {
		$meta->name_key('username')
			->sorting(array('username' => 'ASC'))
			->fields(array(
			'id' => new Field_Primary,
			'username' => new Field_String(array(
				'label' => 'Login',
				'unique' => TRUE,
				'rules' => array(
						'not_empty' => array(TRUE),
						'max_length' => array(32),
						'min_length' => array(3),
						'regex' => array('/^[\pL_.-]+$/ui')
					)
				)),
			'password' => new Field_Password(array(
				'label' => 'Hasło',
				'hash_with' => array(Auth::instance(), 'hash_password'),
				'rules' => array(
					'not_empty' => array(TRUE),
					'max_length' => array(50),
					'min_length' => array(3)
				)
			)),
			'password_confirm' => new Field_Password(array(
				'label' => 'Powtórz hasło',
				'in_db' => FALSE,
				'callbacks' => array(
					'matches' => array('Model_Auth_User', '_check_password_matches')
				),
				'rules' => array(
					'not_empty' => array(TRUE),
					'max_length' => array(50),
					'min_length' => array(3)
				)
			)),
			'logins' => new Field_Integer(array(
				'default' => 0
			)),
			'last_login' => new Field_Timestamp,
			'tokens' => new Field_HasMany(array(
				'foreign' => 'user_token'
			)),
			'roles' => new Field_ManyToMany(array(
				'label' => 'Role',	
			))
		));
    }
}