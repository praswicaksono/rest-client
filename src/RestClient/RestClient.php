<?php

namespace RestClient;

/**
 * Class RestClient
 * @package RestClient
 */
abstract class RestClient implements RestClientInterface
{
    /**
     * @param string $url
     * @param string $method
     * @param array $header
     * @param array $data
     * @param array $auth
     * @param bool $forceInit
     * @return mixed
     */
    abstract public function executeQuery($url, $method = 'GET', $header = array(), $data = array(), $auth = array(), $forceInit = false);

    /**
     * function getName
     * @return mixed
     */
    abstract public function getName();

    /**
     * Close channel
     *
     * @return void
     */
    abstract public function close();
}
