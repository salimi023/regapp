<?php
// PHP version checking due to Composer requirements (7.4.0)
if(version_compare(PHP_VERSION, '7.4.0', '<=')) {    
    exit('Sorry, the minimum required PHP version is 7.4.0');        
} 

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
Logs::Logging($_SERVER['STATUS']);

require_once(dirname(__FILE__, 2) . '/classes/DB.php');                 // Database
$db = new DB();

require_once(dirname(__FILE__, 2) . '/classes/EmailToken.php');         // Email Token
require_once(dirname(__FILE__, 2) . '/classes/Email.php');              // Email

// Controllers
if(isset($_GET['token'])) {
    require_once(dirname(__FILE__, 2) . '/controllers/confirm.php');    // Confirm
}

// Cronjobs
require_once(dirname(__FILE__, 2) .  '/classes/Cron.php');              // Cron

if(isset($_GET['cron'])) {
    $action = $_GET['cron'];
    Cron::$action();
}

// Routing
require_once('router.php');
