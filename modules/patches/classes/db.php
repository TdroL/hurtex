<?php defined('SYSPATH') or die('No direct script access.');

class DB extends Kohana_DB
{
	public static function begin()
	{
		DB::query(NULL, 'BEGIN')->execute();
	}

	public static function commit()
	{
		DB::query(NULL, 'COMMIT')->execute();
	}
	
	public static function rollback()
	{
		DB::query(NULL, 'ROLLBACK')->execute();
	}

}
