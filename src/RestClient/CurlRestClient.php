<?php

namespace RestClient;

/**
 * Class CurlRestClient
 * @package RestClient
 */
class CurlRestClient extends RestClient
{
    /**
     * @var $connectionTimeout null
     */
    private $connectionTimeout;
    /**
     * @var $timeout null
     */
    private $timeout;

    /**
     * @param null $connectionTimeout
     * @param null $timeout
     */
    public function __construct($connectionTimeout = null, $timeout = null)
    {
        $this->connectionTimeout = $connectionTimeout;
        $this->timeout = $timeout;
    }

    /**
     * function executeQuery
     * @param string $url
     * @param string $method
     * @param array $header
     * @param array $data
     * @param array $auth
     * @return mixed
     */
    public function executeQuery($url, $method = 'GET', $header = array(), $data = array(), $auth = array())
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if (!empty($auth)) {
            curl_setopt($curl, CURLOPT_HTTPAUTH, $auth['CURLOPT_HTTPAUTH']);
            curl_setopt($curl, CURLOPT_USERPWD, $auth['username'] . ':' . $auth['password']);
        }

        if ($method == 'POST') {
            curl_setopt($curl, CURLOPT_POST, true);
            if (!empty($data)) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            } else {
                curl_setopt($curl, CURLOPT_POSTFIELDS, array());
            }
        } elseif ($method == 'PUT') {
            if (!empty($data)) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            } else {
                curl_setopt($curl, CURLOPT_POSTFIELDS, array());
            }
        } elseif ($method == 'DELETE') {
            if (!empty($data)) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            } else {
                curl_setopt($curl, CURLOPT_POSTFIELDS, array());
            }
        }

        return curl_exec($curl);
    }

    /**
     * function getName
     * @return string
     */
    public function getName()
    {
        return 'curl';
    }
}
