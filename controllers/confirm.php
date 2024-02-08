<?php
/**
 * Confirm page
 */

$message = '';

 if(isset($_GET['token'])) {
    if(EmailToken::validateToken($_GET['token'])) {
        $update = DB::updateData('applicant', $_GET['id']);

        if($update) {
            $message = 'Regisztrációdat megerősítettük. Köszönjük!';            
        } else {
            $message = 'A regisztráció megerősítése nem sikerült. Kérlek, próbáld meg újra.';
        }
    } else {
        $message = 'A regisztráció hitelesítése sajnos nem sikerült.';
    }
}

require_once(dirname(__FILE__, 2) . '/view/pages/confirm.php');