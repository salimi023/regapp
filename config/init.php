<?php
// Composer autoload file
require_once(dirname(__FILE__, 2) . '/libs/vendor/autoload.php');

// Environmental variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Error reporting
require_once(dirname(__FILE__, 2) . '/classes/Logs.php');
Logs::Logs($_SERVER['STATUS']);

// Database
require_once(dirname(__FILE__, 2) . '/libs/rb-mysql.php');
require_once(dirname(__FILE__, 2) . '/classes/DB.php');
$db = new DB;

// Token
require_once(dirname(__FILE__, 2) . '/classes/EmailToken.php');

// Routing
require_once('router.php');