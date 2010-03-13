<?php defined('SYSPATH') or die('No direct script access.');

class Date extends Kohana_Date
{
	public static function get_month($month)
	{
		$months = Kohana::message('months');
		return $months[$month];
	}
}
