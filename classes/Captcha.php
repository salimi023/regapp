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

        $dayname = match($today_eng) {
            'sunday' => 'vasárnap',
            'monday' => 'hétfő',
            'tuesday' => 'kedd',
            'wednesday' => 'szerda',
            'thursday' => 'csütörtök',
            'friday' => 'péntek',
            'saturday' => 'szombat'
        };        
        
        $return_value = $captcha_local === $dayname ? true : false;        
        
        return $return_value;        
    }
}