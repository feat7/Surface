<?php

namespace app\controllers;

use system\controllers\Controller;
use app\models\User;


/**
* Welcome Controller
*/
class Welcome extends Controller
{
	public function welcomeToSurface()
	{
		return view('welcome.html');
	}
}