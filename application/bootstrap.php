<?php defined('SYSPATH') or die('No direct script access.');

// define('_GRAY', TRUE);

//-- Environment setup --------------------------------------------------------

/**
 * Set the default time zone.
 *
 * @see  http://docs.kohanaphp.com/about.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('Europe/Warsaw');

/**
 * Set the default locale.
 *
 * @see  http://docs.kohanaphp.com/about.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'pl_PL.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://docs.kohanaphp.com/about.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

//-- Configuration and initialization -----------------------------------------

/**
* Set if the application is in development (FALSE)
* or if the application is in production (TRUE).
*/
!isset($_SERVER['SERVER_NAME']) and $_SERVER['SERVER_NAME'] = 'localhost';
define('IN_PRODUCTION', $_SERVER['SERVER_NAME'] != 'localhost');

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
 
if(IN_PRODUCTION)
{
	error_reporting(E_ALL ^ E_NOTICE);
}

Kohana::init
(
	array
	(
		'base_url' => '/projekt/', 
		'index_file' => FALSE,
		'profile' => !IN_PRODUCTION, // Disabling profiling if we are in production
		'caching' => IN_PRODUCTION, // Enable caching if we are in production
	)
);

I18n::$lang = 'pl-pl';

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Kohana_Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Kohana_Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	 'patches'		=> MODPATH.'patches',
	 'firephp'		=> MODPATH.'firephp',    // FirePHP library
	 'database'		=> MODPATH.'database',   // Database access
	 'jelly'		=> MODPATH.'jelly',      // Object Relationship Mapping
	 'jelly-auth'	=> MODPATH.'jelly-auth',	// Jelly Auth driver
	 'auth'			=> MODPATH.'auth',			// Basic authentication
	 'pagination'	=> MODPATH.'pagination', // Paging of results
	));

/**
 * Attach the FirePHP to logging
 */
if(class_exists('FirePHP_Log_Console'))
{
	Kohana::$log->attach(new FirePHP_Log_Console);
}

/**
 * Attach a database reader to config.
 */
Kohana::$config->attach(new Kohana_Config_Database);

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
 
 	Route::set('admin', 'admin(/<controller>(/<action>(.<id>)))', 
		array(
			'id'			=> '\d++',
		))
		->defaults(array(
			'directory'		=> 'protected',
			'controller'	=> 'main',
			'action' 		=> 'index',
			'id'			=> NULL,
		));

	Route::set('default', '(<controller>(/<action>(.<id>)))(/from:<from>)(/page-<page>)', 
		array(
			'id'			=> '\d++',
			'page'			=> '\d++',
			'from'			=> '.++',
		))
		->defaults(array(
			'directory'		=> 'public',
			'controller'	=> 'products',
			'action' 		=> 'index',
			'id'			=> NULL,
			'from'			=> NULL,
			'page'			=> 1,
		));
/**
 * Execute the main request. A source of the URI can be passed, eg: $_SERVER['PATH_INFO'].
 * If no source is specified, the URI will be automatically detected.
 */


$request = Request::instance();

if(IN_PRODUCTION === TRUE)
{
	try
	{
		// Attempt to execute the response
		$request->execute()
				->send_headers();
	}
	catch(Kohana_View_Exception $e)
	{
		// Create a 404 response
		$request->status = 404;
		$request->response = new View('public/template');
		$request->response->content = new View('public/404');
		$request->response->content->message = $e->getMessage();
	}
	catch(Exception $e)
	{
		// If there was an internal server error, we should record it for analysis
		Kohana::$log->add('500', $e.PHP_EOL.'URI: '.$request->uri);
		$request->status = 500;
		$request->response = new View('public/template');
		$request->response->content = new View('public/404');
		$request->response->content->message = 'error'.$e->getMessage();
	}
}
else
{
	// Attempt to execute the response
	try
	{
		$request->execute()
				->send_headers();
	}
	catch(Exception $e)
	{
		Kohana::$log->add('Exception', $e);
		throw $e;
	}
}

echo $request->response;

if(!Request::$is_ajax and !IN_PRODUCTION and class_exists('FirePHP_Profiler'))
{
	FirePHP_Profiler::instance()
		->superglobals()
		->database()
		->benchmark();
}