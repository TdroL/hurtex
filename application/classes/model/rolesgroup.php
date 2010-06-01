<?php defined('SYSPATH') or die('No direct script access.');

class Model_Rolesgroup extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
				'id' => new Field_Primary,
				'name' => new Field_String(array(
					'label' => 'Nazwa',
				)),
				'roles' => new Field_ManyToMany(array(
					'label' => 'Role',
				)),
				'users' => new Field_HasMany(array(
					'label' => 'Użytkownicy',
				)),
			));
	}

}