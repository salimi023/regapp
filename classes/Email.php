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
    public static function SendEmail($email, $name, $selected_date, $applicant_id)
    {
        $token = EmailToken::issueToken($applicant_id);         
        $url = $_SERVER['BASE_URL'] . 'config/init.php?id=' . $applicant_id . '&token=' . $token;         

        $html_msg = "<p><strong>Kedves {$name}!</strong></p>";
        $html_msg .= "A <strong>{$email}</strong> címeddel regisztráció érkezett a <strong>Női Önvédelem Nyílt Napra.</strong><br />";
        $html_msg .= "A nyílt nap regisztrált időpontja: <strong>{$selected_date} délelőtt 10-12 óra.</strong><br />";
        $html_msg .= "Helyszín: <strong>Amazon Stúdió, Dunakeszi Magyar utca 59.</strong><br />";
        $html_msg .= "Amennyiben Te regisztráltál kérlek, azt erre a <a href=\"{$url}\">HIVATKOZÁSRA</a> kattintva erősítsd meg.<br />";
        $html_msg .= "A regisztráció megerősítésére <strong>2 nap</strong> áll rendelkezésedre, ezt követően a regisztráció törlődik.<br />";
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