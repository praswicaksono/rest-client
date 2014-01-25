<?php

namespace RestClient;

abstract class RestClient implements RestClientInterface
{
	abstract public function executeQuery($url, $method = 'GET', $header = array(), $data = '');

	abstract public function getName();
}