<?php


namespace QuizAPI\Api;


class User
{
    private $user_id;
    private $username;
    private $email;
    private $password;
    private $connection;


    /**
     * Requires client to be authenticated with client_id and token
     *
     * Requires an array with the following key:
     * - amount
     *
     * @param int $user_id
     * @param array $data
     * @return array with new balance and success message
     */
    public static function topUpBalance($user_id, $data)
    {
        $connection = new Connection();

        return $connection->post('/user/'.$user_id.'/topUpBalance', $data);
    }

    /**
     * Requires client to be authenticated with client_id and token
     *
     * @param int $user_id
     * @return array with user quiz related information and success message
     */
    public static function getInfo($user_id)
    {
        $connection = new Connection();

        return $connection->get('/user/'.$user_id.'/info');
    }

    /**
     * Requires client to be authenticated with client_id and token
     *
     * @param int $user_id
     * @return array with user personal information and success message
     */
    public static function getDetails($user_id)
    {
        $connection = new Connection();

        return $connection->get('/user/'.$user_id.'/details');
    }

    /**
     * Requires client to be authenticated with client_id and token
     *
     * @param int $user_id
     * @return array with question, possible answers, user_question_id (needed in the response) and success message
     * if user is eligible to play
     */
    public static function getQuestion($user_id)
    {
        $connection = new Connection();

        return $connection->get('/user/'.$user_id.'/question');
    }

    /**
     * Requires client to be authenticated with client_id and token
     *
     * * Requires an array with the following keys:
     * - question_id
     * - nswer_id
     * - user_question_id
     *
     * @param int $user_id
     * @param array $data
     * @return array with flag for corectnes of answer and points won so far and success message
     */
    public static function answerQuestion($user_id, $data)
    {
        $connection = new Connection();

        return $connection->post('/user/'.$user_id.'/questionResponse', $data);
    }

}