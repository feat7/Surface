<?php

/**
* @Entry
* @Surface Framework
* @Author: Vinay Khobragade
* @Contact me: vinaykhobragade99@gmail.com
* @Github: github.com/feat7
*/
use \app\config\Config;
use Illuminate\Events\Dispatcher;
use \Whoops\Handler\PrettyPageHandler;

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;

if (! file_exists(__DIR__ . '/env.config.php')) {
    exit('Environment file not found. Please coyp env.config.example.php to env.config.php or see the documentation for more details');
}

require_once 'env.config.php';

session_start(); //The game begins

/**
 * @Implementing Autoloader with two base namespaces.
 */
$loader = require 'vendor/autoload.php';
$loader->add('system', __DIR__);
$loader->add('app', __DIR__);

if (APP_MODE == '__DEV__') {
    ini_set('display_errors', 'on');

    //Just for development mode
    $whoops = new \Whoops\Run();
    $whoops->prependHandler(new PrettyPageHandler());
    $whoops->register();
} else if (APP_MODE == '__PRODUCTION__') {
    ini_set('display_errors', 'off');
} 



/**
 * @Let us eat a capsule to use eloquent
 */
$capsule = new Capsule();

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

$capsule->setEventDispatcher(new Dispatcher(new Container()));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent(); //eloquent boot done

$kernel = new system\Kernel(); //boot kernel

/**
 * @function view
 * @param view: string | path to view template
 * @param vars: array | inject variabes into view template
 * @param mixed $view
 * @param mixed $vars
 */
function view($view, $vars = [])
{
    $twigLoader = new Twig_Loader_Filesystem('./app/views');
    $twig = new Twig_Environment($twigLoader, [
        'cache' => './app/cache',
        'auto_reload' => true,
        'debug' => true,
    ]);
    $twig->addExtension(new Twig_Extension_Debug());
    $template = $twig->loadTemplate($view);
    echo $template->render($vars);
}
