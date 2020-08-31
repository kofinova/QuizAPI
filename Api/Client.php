<?php


namespace QuizAPI\Api;

use \Exception as Exception;

/**
 * Quiz API Client
 */
class Client
{
    private static $client_id;
    private static $password;
    private static $token;

    private static $connection;

    /**
     * Requires an array with the following keys:
     *
     * - client_id
     * - hashed password with sha512
     *
     * @param array $data
    */
    public static function getToken($data)
    {
        $connection = new Connection();

        return $connection->post('/token', $data);
    }

    /**
     * Requires a settings array with the following keys:
     *
     * - client_id
     * - hashed password with sha512
     * - token
     *
     * @param array $settings
     */
    public static function configureAuth($settings)
    {
        if (!isset($settings['token'])) {
            throw new Exception("'token' must be provided");
        }

        self::$client_id = $settings['client_id'];
        self::$password = $settings['password'];
        self::$token = $settings['token'];


        self::$connection = new Connection();
        self::$connection->authenticate(self::$client_id, self::$token);
    }
}