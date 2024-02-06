<?php
/**
 * Confirmation E-mail Class (PHPMailer)
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Composer autoload file
require_once(dirname(__FILE__, 2) . '/libs/vendor/autoload.php');

final class Email
{
    
    /**
     * Sending Confirmation E-mail
     * 
     * @param string $email
     * @param string $name
     * @param date $selected_date
     * @param integer $applicant_id
     * 
     * @return string 
     */
    public static function Confirm($email, $name, $selected_date, $applicant_id)
    {
        $url = $_SERVER['BASE_URL'] . 'confirm/' . $applicant_id;         

        $html_msg = "<p><strong>Kedves {$name}!</strong></p>";
        $html_msg .= "A {$email} címeddel regisztráció érkezett a Női Önvédelem Nyílt Napra.<br />";
        $html_msg .= "A nyílt nap időpontja: {$selected_date}<br />";
        $html_msg .= "Amennyiben Te regisztráltál kérlek, azt erre a <a href=\"{$url}\">HIVATKOZÁSRA</a> kattintva erősítsd meg.<br />";
        $html_msg .= 'Ha nem Te regisztráltál kérlek, hagyd ezt az e-mailt figyelmen kívül.';
        $html_msg .= '<p>Üdvözlettel: Megyeri József</p>';

        $mail = new PHPMailer(true);
         
        $mail->CharSet = 'utf-8';
        $mail->Encoding = 'base64';
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                                    //Enable verbose debug output
        $mail->isSMTP();                                                            //Send using SMTP                             
        $mail->Host       = $_SERVER['EMAIL_HOST'];        
        $mail->Port       = $_SERVER['EMAIL_PORT'];                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`         
            
        //Recipients
        $mail->setFrom('dunakeszijitsu@gmail.com', 'Villási Ju-Jitsu Egyesület');
        $mail->addAddress($email, $name);                                           //Add a recipient                               
        
        //Content
        $mail->isHTML(true);                                                        //Set email format to HTML
        $mail->Subject = 'Regisztráció Nyílt Napra ';
        $mail->Body    = $html_msg;        
        
        if($mail->send()) {
            $result = true;
        } else {
            $result = false;
        }              

        return $result;                       
    }
}