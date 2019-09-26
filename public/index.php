<?php
require 'vendor/autoload.php';

use todo\components\Db;
use todo\components\Router;

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));

session_start();

$router = new Router();
$db = new Db();
$db->getConnection();
$router->run();
