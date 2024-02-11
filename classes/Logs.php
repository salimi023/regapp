<?php
/**
 * Logging Class
 */

 final class Logs 
 {
    
    /**
     * Error logging
     * 
     * @param String $app_status (DEVELOPMENT, PRODUCTION)
     */
    
    public static function Logging($app_status)
    {
        $display = $app_status === 'DEVELOPMENT' ? true : false;
        
        error_reporting(E_ALL & ~E_NOTICE);
        ini_set('ignore_repeated_errors', FALSE);
        ini_set('display_errors', $display);
        ini_set('log_errors', TRUE);
        ini_set('error_log', 'logs/error.log');            
    } 
 }
 