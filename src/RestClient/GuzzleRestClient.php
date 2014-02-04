<?php

namespace RestClient;

use Guzzle\Http\Client;

/**
 * Class GuzzleRestClient
 * @package RestClient
 */
class GuzzleRestClient extends RestClient
{
    /**
     * @var $client \Guzzle\Http\Client
     */
    private $client;

    /**
     *
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * function executeQuery
     * @param string $url
     * @param string $method
     * @param array $header
     * @param string $data
     * @return mixed
     */
    public function executeQuery($url, $method = 'GET', $header = array(), $data = '')
    {
        switch ($method) {
            case 'GET':
                $request = $this->client->get($url, $header);
                break;
            case 'POST':
                $request = $this->client->post($url, $header, $data);
                break;
            case 'PUT':
                $request = $this->client->get($url, $header, $data);
                break;
            case 'DELETE':
                $request = $this->client->get($url, $header, $data);
                break;
            default:
                $request = $this->client->get($url, $header, $data);
        }

        $response = $request->send();

        return $response->getBody(true);
    }

    /**
     * function getName
     * @return string
     */
    public function getName()
    {
        return 'guzzle';
    }
}
