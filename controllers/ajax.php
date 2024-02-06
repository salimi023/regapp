<?php
/**
 * Ajax function
 */
require_once(dirname(__FILE__, 2). '/classes/Ajax.php');

if(isset($_POST['name'])) {

    $applicant_data = [
        'captcha' => $_POST['captcha'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'selected_date' => $_POST['selected_date'],
        'consent' => $_POST['consent'],
        'reg_date' => date('Y-m-d')
    ];
}

$result = Ajax::Ajax($applicant_data);

echo $result;