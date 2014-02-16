<?php

namespace RestClient;

/**
 * Class CurlRestClient
 * @package RestClient
 */
class CurlRestClient extends RestClient
{
    /**
     * @var $url null
     */
    private $url;
    /**
     * @var $header array
     */
    private $header;
    /**
     * @var $auth array
     */
    private $auth;
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
    public function __construct($url, $header = array(), $auth = array(), $connectionTimeout = null, $timeout = null)
    {
        $this->url = $url;
        $this->header = $header;
        $this->auth = $auth;
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

        if($method == 'GET')
            $url = $url.'?'.http_build_query($data);

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
            curl_setopt($curl, CURLOPT_PUT, true);
            if (!empty($data)) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            } else {
                curl_setopt($curl, CURLOPT_POSTFIELDS, array());
            }
        } elseif ($method == 'DELETE') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            if (!empty($data)) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            } else {
                curl_setopt($curl, CURLOPT_POSTFIELDS, array());
            }
        }

        return curl_exec($curl);
    }

    private function call($method, $segment, $data = array())
    {
        return $this->executeQuery($this->url.'/'.$segment, $method, $this->header, $data, $this->auth);
    }

    public function get($segment, $data = array())
    {
        return $this->call('GET', $segment, $data);
    }

    public function post($segment, $data)
    {
        return $this->call('POST', $segment, $data);
    }

    public function put($segment, $data)
    {
        return $this->call('PUT', $segment, $data);
    }

    public function delete($segment, $data)
    {
        return $this->call('DELETE', $segment, $data);
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
