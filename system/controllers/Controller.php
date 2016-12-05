<?php

namespace system\controllers;

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
		return (isset($_GET[$name])) ? htmlspecialchars(trim($_GET[$name])) : null;
	}

	public function post($name)
	{
		return (isset($_POST[$name])) ? htmlspecialchars(trim($_POST[$name])) : null;
	}
}