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

// Confirm page
$router->get('/confirm/(\d+)?(\w+)', function($id, $token) {    
    header('Location: ' . $_SERVER['BASE_URL'] . 'controllers/confirm.php?id=' . $id . '&token=' . $token);
});

// Run it!
$router->run();
