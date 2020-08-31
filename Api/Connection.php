<?php


namespace QuizAPI\Api;

use \Exception as Exception;

/**
 * HTTP connection.
 */
class Connection
{
    const CONTENT_TYPE = 'application/json';
    const TIMEOUT = 'application/json';

    private $curl;
    private $headers = array();
    private $responseBody;
    private static $api_url = 'https://service.quiz.com';


    public function __construct()
    {
        $this->curl = curl_init();

        $this->addHeader('Content-Type', self::CONTENT_TYPE);
        $this->addHeader('Accept', self::CONTENT_TYPE);

        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_WRITEFUNCTION, array($this, 'parseBody'));
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, self::TIMEOUT);
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, self::TIMEOUT);
    }

    public function __destruct()
    {
        curl_close($this->curl);
    }

    public function addHeader($header, $value)
    {
        $this->headers[$header] = "$header: $value";
    }

    public function get($url)
    {
        curl_setopt($this->curl, CURLOPT_HTTPGET, true);
        curl_setopt($this->curl, CURLOPT_POST, false);
        curl_setopt($this->curl, CURLOPT_URL, $url);

        curl_exec($this->curl);

        return $this->handleResponse();
    }

    public function post($url, $body)
    {
        curl_setopt($this->curl, CURLOPT_HTTPGET, false);
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_URL, self::$api_url . $url);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $body);

        curl_exec($this->curl);

        return $this->handleResponse();
    }

    private function parseBody($curl, $body)
    {
        $this->responseBody .= $body;
        return strlen($body);
    }

    public function handleResponse()
    {
        $body = json_decode($this->getBody());
        $status = $this->getStatus();

        if ($status >= 400 && $status <= 599) {
            throw new Exception($body, $status);
        }

        return $body;
    }

    public function getBody()
    {
        return $this->responseBody;
    }

    public function getStatus()
    {
        return curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
    }

    public function authenticate($clientId, $token)
    {
        $this->addHeader('X-Auth-Client', $clientId);
        $this->addHeader('X-Auth-Token', $token);
    }
}