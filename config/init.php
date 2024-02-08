<?php

// Composer autoload file
require_once(dirname(__FILE__, 2) . '/libs/vendor/autoload.php');

// Environmental variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// ORM
require_once(dirname(__FILE__, 2) . '/libs/rb-mysql.php');

// Token
use ReallySimpleJWT\Token;

// Classes
require_once(dirname(__FILE__, 2) . '/classes/Logs.php');               // Error reporting
Logs::Logs($_SERVER['STATUS']);

require_once(dirname(__FILE__, 2) . '/classes/DB.php');                 // Database
$db = new DB();

require_once(dirname(__FILE__, 2) . '/classes/EmailToken.php');         // Email Token
require_once(dirname(__FILE__, 2) . '/classes/Email.php');              // Email

// Controllers
if(isset($_GET['token'])) {
    require_once(dirname(__FILE__, 2) . '/controllers/confirm.php');    // Confirm
}

// Routing
require_once('router.php');
