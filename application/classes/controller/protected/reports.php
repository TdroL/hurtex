<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Reports extends Controller_Admin
{
	public function action_index()
	{
		$this->content->bind('errors', $errors);
		
		$validate = Validate::factory($_POST)
							->labels(array(
								'date_start' => 'Data od',
								'date_end' => 'Data do',
							))
							->filter(TRUE, 'trim')
							->rule('date_start', 'date')
							->rule('date_end', 'date');
		
		if(!$validate->check())
		{
			$errors = $validate->errors('validate');
			
			$_POST['date_start'] = date('Y-m-d', time() - 7 * 24 * 60 * 60);
			$_POST['date_end'] = date('Y-m-d');
		}
		
		$_POST['date_start'] = arr::get($_POST, 'date_start', date('Y-m-d', time() - 7 * 24 * 60 * 60));
		$_POST['date_end'] = arr::get($_POST, 'date_end', date('Y-m-d'));
		
		$orderproducts = Jelly::select('orderproduct')
						->get_span(strtotime($_POST['date_start']), strtotime($_POST['date_end']))
						->execute();
		
		$this->content->sum_netto = 0;
		
		$products = array();		
		foreach($orderproducts as $v)
		{
			if(empty($products[$v->id]) or empty($products[$v->id][$v->product->price->id]))
			{
				$products[$v->id][$v->product->price->id] = $v;
			}
			else
			{
				$products[$v->id][$v->product->price->id]->quantity += $v->quantity;
			}
			
			$this->content->sum_netto += $v->product->price->value * $v->quantity;
		}
		
		$this->content->products = $products;
	}
}
