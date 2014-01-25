<?php

namespace RestClient;

use Guzzle\Http\Client;

class GuzzleRestClient extends RestClient
{
	private $client;

	public function __construct()
	{
		$this->client = new Client();
	}

	public function executeQuery($url, $method = 'GET', $header = array(), $data = '')
	{
		switch ($method) {
			case 'GET':
				$request = $this->client->get($url, $header);
				break;
			case 'POST':
				$request = $this->client->get($url, $header, $data);
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

	public function getName()
	{
		return 'guzzle';
	}
}