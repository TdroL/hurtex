<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Abstract controller class for automatic templating.
 *
 * @package    Controller
 * @author     Kohana Team
 * @copyright  (c) 2008-2009 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
 
abstract class Controller_Template extends Controller {

	/**
	 * @var  string  page template
	 */
	public $view = 'template';
	public $content = TRUE;
	public $no_view = array();
	public $no_template = array();

	/**
	 * @var  boolean  auto render template
	 **/
	public $auto_render = TRUE;

	public $db;
	public $session;

	/**
	 * Loads the template View object.
	 *
	 * @return  void
	 */
	public function before()
	{
		$this->session = Session::instance();
		if ($this->auto_render === TRUE and $this->view !== NULL and !in_array($this->request->action, $this->no_view))
		{
			if(Request::$is_ajax)
			{
				$this->content = new View((!empty($this->request->directory) ? $this->request->directory.'/' : NULL).$this->request->controller.'/'.$this->request->action);
				$this->view =& $this->content;
			}
			else
			{
				if(!in_array($this->request->action, $this->no_template))
				{
					$this->view = new View((!empty($this->request->directory) ? $this->request->directory.'/' : NULL).$this->view);
					
					if($this->content === TRUE)
					{
						$this->view->content = new View((!empty($this->request->directory) ? $this->request->directory.'/' : NULL).$this->request->controller.'/'.$this->request->action);
						$this->content =& $this->view->content;
					}
				}
				else
				{
					if($this->content === TRUE)
					{
						$this->content = new View((!empty($this->request->directory) ? $this->request->directory.'/' : NULL).$this->request->controller.'/'.$this->request->action);
					}
					
					$this->view =& $this->content;
				}
			}
		}
	}

	/**
	 * Assigns the template as the request response.
	 *
	 * @param   string   request method
	 * @return  void
	 */
	public function after()
	{
		if ($this->auto_render === TRUE and !in_array($this->request->action, $this->no_view))
		{
			// Assign the template as the request response and render it
			$this->view->set_global('request', $this->request);
			$this->view->bind_global('obj', $this);
			$this->request->response = $this->view;
		}
	}
	
	public function param($name, $default = NULL)
	{
		return $this->request->param($name, $default);
	}
	
	public function site(array $params = array())
	{
		return url::site($this->request->uri($params));
	}

} // End Controller_Template