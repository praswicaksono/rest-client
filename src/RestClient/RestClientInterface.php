<?php

namespace RestClient;

/**
 * Class RestClientInterface
 * @package RestClient
 */
interface RestClientInterface
{
    /**
     * @param $url
     * @param string $method
     * @param array $header
     * @param array $data
     * @param array $auth
     * @param bool $forceInit
     * @return mixed
     */
    public function executeQuery($url, $method = 'GET', $header = array(), $data = array(), $auth = array(), $forceInit = false);

    /**
     * function getName
     * @return mixed
     */
    public function getName();

    /**
     * Close channel
     *
     * @return void
     */
    public function close();
}
