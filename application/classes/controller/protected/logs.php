<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Protected_Logs extends Controller_Auth
{
	public $access = array(
		TRUE => 'admin'
	);
	
	public $no_template = array('list');
	
	public function action_index()
	{
		$latest = Kohana::list_files('logs');
		$key = NULL;
		
		for($i = 0; $i < 3; $i++)
		{
			$keys = array_keys($latest); // by years
			
			if(empty($keys))
			{
				$key = NULL;
				break;
			}
			
			natsort($keys);
			$key = array_pop($keys);
			$latest = $latest[$key];
		}
		
		if(!empty($key))
		{
			$key = str_replace(array('\\', 'logs'), array('/', NULL), $key);
			$key = trim($key, '/');
		}
		
		$path = $this->param('path', $key);
		$this->content->path = $path;
		$this->content->bind('file', $file);
		
		$path = APPPATH.'logs/'.$path;
		
		$file = array();
		
		if(file_exists($path) and is_file($path))
		{
			$lines = file($path);
			$i = -1;
			
			foreach($lines as $k => $v)
			{
				$v = trim($v);
				
				if(empty($v) or preg_match('/^<\?php .*? \?>$/i', $v))
				{
					continue;
				}
				
				if(preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/i', $v))
				{
					$i++;
					$file[$i] = $v;
				}
				else
				{
					$file[$i] .= PHP_EOL.$v;
				}
			}
		}
	}
	
	public function action_list()
	{
		$logs = Kohana::list_files('logs');

		$active = $this->param('path');
		
		// Create directory array
		$dir = array();
		
		if( $logs )
		{
			krsort($logs);

			foreach( $logs as $years => $months )
			{
				krsort( $months );

				foreach( $months as $path => $files )
				{
					krsort($files);

					foreach( $files as $file => $path )
					{
						$file = str_replace('\\', '/', $file);
						list( $logs, $year, $month, $fn ) = explode( '/', $file );
						$day = explode('.', $fn);
						$dir[$year][$month][$day[0]] = str_replace('logs/', '', $file);
					}

				}

			}
		}
		
		$this->content->dir = $dir;
		$this->content->active = $active;
	}
}