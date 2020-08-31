<?php


namespace QuizAPI\Api;


class UserManager
{
    /**
     * Requires client to be authenticated with client_id and token
     *
     * Requires an array with the following key:
     * - email
     *
     * @param array $data
     * @return bool Returns true if exists, false if not
     */
    public static function checkEmail($data)
    {
        $connection = new Connection();

        return $connection->post('/user/checkEmail', $data);
    }

    /**
     * Requires client to be authenticated with client_id and token
     *
     * Requires an array with the following key:
     * - username
     *
     * @param array $data
     * @return bool Returns true if exists, false if not
     */
    public static function checkUsername($data)
    {
        $connection = new Connection();

        return $connection->post('/user/checkUsername', $data);
    }

    /**
     * Requires client to be authenticated with client_id and token
     *
     * Requires an array with the following keys:
     * - email
     * - username
     * - password
     * - plan_id
     *
     * @param array $data
     * @return array with user id and success message
     */
    public static function createUser($data)
    {
        $connection = new Connection();

        return $connection->post('/user/create', $data);
    }

    /**
     * Requires client to be authenticated with client_id and token
     *
     * @param $user_id
     * @return array with success message
     */
    public static function verifyUser($user_id)
    {
        $connection = new Connection();

        return $connection->post('/user/verify', $user_id);
    }

    /**
     * Requires client to be authenticated with client_id and token
     *
     * * Requires an array with the following keys:
     * - email
     * - password
     *
     * @param array $data
     * @return array with user id and success message if user is found, error message if not
     */
    public static function logInUser($data)
    {
        $connection = new Connection();

        return $connection->post('/user/login', $data);
    }
}