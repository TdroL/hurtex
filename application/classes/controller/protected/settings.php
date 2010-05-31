<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Settings extends Controller_Admin
{
	public function action_index()
	{
		$this->content->bind('errors', $errors);
		$this->content->bind('success', $success);
		$this->content->bind('form', $form);
		$this->content->bind('fields', $fields);
		
		$form = $this->company;
		$success = FALSE;
		
		$fields = array('name' => 'Nazwa firmy',
						'account' => 'Numer konta',
						'address' => 'Adres',
						'nip' => 'NIP',
						);
		
		if($_POST)
		{
			$form = array_intersect_key($_POST, $fields);
			
			$validate = Validate::factory($form)
								->labels($fields)
								->rule(TRUE, 'not_empty')
								->rule('account', 'account_number')
								->rule('nip', 'nip');
			
			if(!$validate->check())
			{
				$errors = $validate->errors('validate');
				$form = (object) $form;
			}
			else
			{
				foreach($form as $k => $v)
				{
					$this->company->set($k, $v);
				}
				
				$form = $this->company;
				$success = TRUE;
			}
		}
		
		$fields = (object) $fields;
	}
}