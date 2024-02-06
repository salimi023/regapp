<?php
/**
 * Ajax
 */
final class Ajax
{
    /**
     * Passing Ajax data to database
     * 
     * @param array $data
     * @return boolean or string
     */    
    public static function Ajax($data = [])
    {
        if(count($data) > 0) {
            // Captcha 
            require_once('Captcha.php');
            $captcha = new Captcha;

            // E-mail
            require_once('classes/Email.php');

            if($captcha->checkCaptcha($data['captcha'])) {
                unset($data['captcha']); 
                $saved_applicant = DB::getApplicantByEmail($data['email']);            
                
                if(!$saved_applicant) {
                    $applicant_id = DB::saveData($data);

                    if($applicant_id) {
                        $email_sending = Email::Confirm($data['email'], $data['name'], $data['selected_date'], $applicant_id);                    
                        
                        if($email_sending) {
                            $result = 'okay';
                        } else {
                            DB::deleteData($applicant_id);
                            $result = 'email_error';
                        }                               
                    } else {
                        $result = 'db_error';
                    }
                } else {
                    $result = 'duplicate_email';
                }

                return $result;
            } else {
                return 'captcha';
            }
        } else {
            return 'no_data';
        }
    } 
} 