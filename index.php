<?php

session_start();


/**
* @Do not Edit.
* @Surface
* @Author: Vinay Khobragade
*/


$loader = require 'vendor/autoload.php';
$loader->add('system', __DIR__);
$loader->add('app', __DIR__);

$kernel = new system\Kernel();




function view($view, $vars = [])
{
	$twigLoader = new Twig_Loader_Filesystem('./app/views');
	$twig = new Twig_Environment($twigLoader, array(
    'cache' => './app/cache',
    'auto_reload' => true,
));
	$template = $twig->loadTemplate($view);
	echo $template->render($vars);
}



