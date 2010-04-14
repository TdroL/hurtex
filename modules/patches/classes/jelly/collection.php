<?php defined('SYSPATH') or die('No direct script access.');

class Jelly_Collection extends Jelly_Collection_Core
{
	public function is_empty()
	{
		return !count($this->as_array());
	}
}