<?php defined('SYSPATH') or die('No direct script access.');

class Model_Unit extends Jelly_Model
{

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->name_key('name')
			->fields(array(
				'id' => new Field_Primary,
				'name' => new Field_String(array(
					'label' => 'Nazwa',
					'rules' => array(
						'not_empty' => NULL,
					),
				)),
				'type' => new Field_Enum(array(
					'label' => 'Typ',
					'null' => FALSE,
					'choices' => array('integer'=>'Liczba całkowita','float'=> 'Liczba rzeczywista'),
				)),
			))
			->sorting(array(':name_key' => 'asc'));
	}

}