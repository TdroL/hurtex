<?php defined('SYSPATH') or die('No direct script access.');

// ----------------
function ORM($model, $id = NULL)
{
	return ORM::factory($model, $id);
}

function Auth()
{
	return Auth::instance();
}