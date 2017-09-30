<?php

/**
* @Entry
* @Surface Framework
* @Author: Vinay Khobragade
* @Contact me: vinaykhobragade99@gmail.com
* @Github: github.com/feat7
*/

use \app\config\Config;
use Illuminate\Database\Capsule\Manager as Capsule;

require_once 'env.config.php';

if(APP_MODE == '__DEV__')
ini_set('display_errors', 'on'); //Just for development mode


session_start(); //The game begins

/**
 * @Implementing Autoloader with two base namespaces.
 */
$loader = require 'vendor/autoload.php';
$loader->add('system', __DIR__);
$loader->add('app', __DIR__);

/**
 * @Let us eat a capsule to use eloquent
 */

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => DB_HOST,
    'database'  => DB_NAME,
    'username'  => DB_USER,
    'password'  => DB_PASS,
    'charset'   => 'utf8',  
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent(); //eloquent boot done


$kernel = new system\Kernel(); //boot kernel

/**
 * @function view
 * @param view: string | path to view template 
 * @param vars: array | inject variabes into view template
 */

function view($view, $vars = [])
{
	$twigLoader = new Twig_Loader_Filesystem('./app/views');
	$twig = new Twig_Environment($twigLoader, array(
	    'cache' => './app/cache',
	    'auto_reload' => true,
        'debug' => true
	));
    $twig->addExtension(new Twig_Extension_Debug());
	$template = $twig->loadTemplate($view);
	echo $template->render($vars);
}
