<?php


namespace QuizAPI\Api;


class Plan
{
    /**
     * Requires client to be authenticated with client_id and token
     *
     * @return array
     */
    public static function getAllPlans()
    {
        $connection = new Connection();

        return $connection->get('/plans');
    }
}