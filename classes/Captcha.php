<?php
/**
 * CAPTCHA CLASS
 */
final class Captcha 
{
    
    /**
     * Checking CAPTCHA value
     * 
     * @param string $captcha
     * @return boolean 
     */
    public function checkCaptcha($captcha) 
    {
        $captcha_local = mb_strtolower($captcha, 'UTF-8');
        $today_eng = strtolower(date('l'));

        if(version_compare(PHP_VERSION, '8.0.0', '<=')) {
            $dayname = match($today_eng) {
                'sunday' => 'vasárnap',
                'monday' => 'hétfő',
                'tuesday' => 'kedd',
                'wednesday' => 'szerda',
                'thursday' => 'csütörtök',
                'friday' => 'péntek',
                'saturday' => 'szombat'
            };
        } else {
            switch($today_eng) {
                case 'sunday':
                    $dayname = 'vasárnap';
                    break;
                
                case 'monday':
                    $dayname = 'hétfő';
                    break;

                case 'tuesday':
                    $dayname = 'kedd';
                    break;

                case 'wednesday':
                    $dayname = 'szerda';
                    break;

                case 'thursday':
                    $dayname = 'csütörtök';
                    break;

                case 'friday':
                    $dayname = 'péntek';
                    break;

                case 'saturday':
                    $dayname = 'szombat';
                    break;                
            }
        }       
        
        $return_value = $captcha_local === $dayname ? true : false;        
        
        return $return_value;        
    }
}