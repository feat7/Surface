<?php

namespace app\controllers;

use \system\controllers\Controller;


/**
* 
*/
class Welcome extends Controller
{
	public function welcomeToSurface()
	{
		return view('welcome.html');
	}
}