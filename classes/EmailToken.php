<?php
/**
 * Token management
 */
use ReallySimpleJWT\Token;

final class EmailToken
{
    private const PASSWORD = 'vil!Lasi423*&';     

    /** 
     * Issuing Token 
     * 
     * @param integer $applicant_id
     * 
     * @return string
     */
    public static function issueToken($applicant_id)
    {
        $expiration = time() + 86400;       // One day
        $issuer = $_SERVER['BASE_URL'];       

        $token = Token::create($applicant_id, self::PASSWORD, $expiration, $issuer);

        return $token;
    }

    /** 
     * Validating Token 
     * 
     * @param string $token
     * 
     * @return boolean
     */
    public static function validateToken($token) 
    {
        $result = Token::validate($token, self::PASSWORD);
        return $result;
    }
}
