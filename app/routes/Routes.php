<?php

namespace app\routes;


class Routes
{
	public function setRoutes()
	{
		$this->routes = [
			'/' => ['uses' => 'Welcome@welcomeToSurface'],
		];

		return $this->routes;
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