<?php
/**
* Author: Vinay Khobragade
* Package: Backend for Aavartan
* Help me with fixes and suggestions
*/

namespace system;


class Kernel
{


	//This is main Kernel Layer


	public function __construct()
	{
		//Kernel Connected

		$routes = new \app\routes\Routes;

		$this->routes = $routes->setRoutes();

		

		$this->currentRequest = ($this->getUriSegment() != '') ? $this->getUriSegment(0) : '/';

		if(array_key_exists($this->currentRequest, $this->routes)) {
			$controllerName = $this->getControllerName($this->routes[$this->currentRequest]['uses']); //Controller Name
			$methodName = $this->getMethodName($this->routes[$this->currentRequest]['uses']); //Method Name

			$params = isset($this->routes[$this->currentRequest]['params']) ? $this->routes[$this->currentRequest]['params'] : array();

			
			$this->runTheController($this->routes[$this->currentRequest]['uses'], $params);

		}
		else {
			return view('error_404.tpl');
		}

		
	}

	private function runTheController($string, $params=array())
	{
		$controllerName = $this->getControllerName($this->routes[$this->currentRequest]['uses']); //Controller Name
		$methodName = $this->getMethodName($this->routes[$this->currentRequest]['uses']); //Method Name

		$objectName = '\app\controllers\\'.$controllerName;

		if(method_exists($objectName, $methodName)) {
			$object = new $objectName;
			//Run Middleware if any before controller

			if(isset($this->routes[$this->currentRequest]['middleware'])) {

				$object->middleware($this->routes[$this->currentRequest]['middleware']);
			}

			$object->{$methodName}($params);
		}
	}

	public function getControllerName($string)
	{
		$controllerName = explode('@', $string)[0];
		return $controllerName;
	}

	public function getMethodName($string)
	{
		$methodName = explode('@', $string)[1];
		return $methodName;
	}


	public function getUriSegment($int=0)
	{
		if(isset(explode('/', trim($_SERVER['REQUEST_URI'], '/'))[$int]))
		{
			return explode('/', trim($_SERVER['REQUEST_URI'], '/'))[$int];
		}
		else return null;
	}
		
}
