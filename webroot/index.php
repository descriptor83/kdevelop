<?php
ini_set('display_errors',1);
error_reporting(32767);

define('ROOT', dirname(__FILE__));
//define('IMG', '/home/paul/vhosts/kdevelop.local/webroot/img/');
//require_once ROOT.'/../vendor/autoload.php';
require_once ROOT.'/../Autoload.php';
require_once ROOT.'/../config/db.php';
/*require_once ROOT.'/../vendor/autoload.php';
require_once ROOT.'/../components/Router.php';
require_once ROOT.'/../config/db.php';
require_once ROOT.'/../controllers/AbstractController.php';
require_once ROOT.'/../models/Table.php';
$cache = new Cache_Lite([
    'cacheDir' => '/tmp/',
    'automaticSerialization' => true,
    'lifeTime' => 600
]);*/

$router = new Router();
$router->run();

