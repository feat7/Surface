<?php

namespace system\controllers;

use \app\libs\Validation;

class Controller {
	public function __construct() {

	
	}

	public function middleware($middleware)
	{
		try {
			$middlewareName = $middleware.'Middleware';
			$middlewareClass = '\app\middlewares\\'.$middlewareName;
			$this->{$middlewareName} = new $middlewareClass; 
		}
		catch(Exception $e) {

		}
	}

	public function get($name)
	{
		return (isset($_GET[$name])) ? htmlspecialchars(trim(strip_tags($_GET[$name]))) : null;
	}

	public function post($name)
	{
		return (isset($_POST[$name])) ? htmlspecialchars(trim(strip_tags($_POST[$name]))) : null;
	}

	public function isPost()
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}

	public function isGet()
	{
		return $_SERVER['REQUEST_METHOD'] == 'GET';
	}

	public function getUriSegment($int=0)
	{
		if(isset(explode('/', trim($_SERVER['REQUEST_URI'], '/'))[$int]))
		{
			return explode('/', trim($_SERVER['REQUEST_URI'], '/'))[$int];
		}
		else return null;
	}

	public function startValidator()
	{
		$this->validator = new Validation;
	}
}