<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Pages extends Controller_Template
{
	public function action_index($pages)
	{
		$this->content->page = ORM('page', array('link' => $pages));
		if(!$this->content->page->loaded())
		{
			throw new Kohana_View_Exception('page ":link" does not exists', array(':link' => $pages));
		}

		/* Commands
			usage:
			{command( param)}
			example:
			{send contact/send} => url::site('contact/send')
			 ^--^ ^----------^     ^-----------------------^
			command  param                  result
		*/
		
		$this->content->page->content = preg_replace_callback('/\{(?<command>[^ \}]+)(?: (?<param>[^\}]+))?\}/im', array($this, 'inline_commands'), $this->content->page->content);
	}
	
	public function action_contact()
	{
		$this->content->bind('post', $post);
		$this->content->bind('errors', $errors);
		
		$post = new FormFields($_POST);
		
		if(!empty($_POST) and !$this->session->get($_POST['sand'], FALSE))
		{
			$validate = Validate::factory($_POST)
					->fields('fields')
					->filter(TRUE, 'trim')
					->rules('email', array(
						'not_empty' 		=> NULL,
						'min_length'		=> array(4),
						'validate::email'	=> NULL,
					))
					->rules('content', array(
						'not_empty'			=> NULL,
					));
					
			if($validate->check())
			{
				$email = $validate['email'];
				$content = $validate['content'];
				
				$config = Kohana::config('email');

				// Load Swift Mailer support
				require Kohana::find_file('vendor', 'swift/lib/swift_required');
				try
				{
					// Connect to the server
					$transport = Swift_SmtpTransport::newInstance($config->server, $config->port)
						->setUsername($config->username)
						->setPassword($config->password);

					$message = Swift_Message::newInstance()
						->setSubject(__('Portfolio: message from :email', array(':email' => $email)))
						->setFrom($email)
						->setTo($config->to)
						->setBody(strip_tags($content))
						->addPart(trim(nl2br(html::chars($content))), 'text/html');
						
					// Send the message
					$failures = NULL;
					if(!Swift_Mailer::newInstance($transport)
						->send($message, $failures))
					{
						throw new Exception($failures);
					}
					
					$this->session->set($_POST['sand'], TRUE);
					$this->content->success = TRUE;
				}
				catch(Exception $e)
				{
					$validate->error('email', 'swiftmailer_error', array($e->getMessage()));
					$errors = $validate->errors('validate');
					$post->set($validate);
				}
			}
			else
			{
				$errors = $validate->errors('validate');
				$post->set($validate);
			}
		}
	}

	// locals
	
	public function inline_commands($matches)
	{
		if(isset($matches['command']))
		{
			switch($matches['command'])
			{
				case 'site':
				{
					return isset($matches['param']) ? url::site($matches['param']) : url::base();
				}
			}
		}
		return $matches[0]; // unknown command or normal text
	}
}