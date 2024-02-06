<?php
/**
 * Token management
 */
use ReallySimpleJWT\Token;

final class EmailToken
{
    private const USER_ID = 1;
    private const PASSWORD = 'sec!ReT423*&';     

    /** Issuing Token */
    public static function issueToken()
    {
        $expiration = time() + 86400;       // One day
        $issuer = $_SERVER['BASE_URL'];       

        $token = Token::create(self::USER_ID, self::PASSWORD, $expiration, $issuer);

        return $token;
    }

    /** Validating Token */
    public static function validateToken($token) 
    {
        $result = Token::validate($token, self::PASSWORD);
        return $result;
    }
}
