<?php
// Create Router instance
$router = new \Bramus\Router\Router();

/** Define routes */

// Index page (form)
$router->get('/', function() {
    require_once(dirname(__FILE__, 2) . '/controllers/form.php');
});

// Ajax
$router->post('/ajax', function() {
    require_once(dirname(__FILE__, 2) . '/controllers/ajax.php');
});

// Run it!
$router->run();
