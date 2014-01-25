<?php

namespace RestClient;

interface RestClientInterface
{
	public function executeQuery($url, $adapter = 'curl', $method = 'GET', $data = '');

	public function getName();
}