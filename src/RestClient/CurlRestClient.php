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
     * @var $options array
     */
    private $options = array();

    private $curl;

    /**
     * @param null $url
     * @param array $header
     * @param array $auth
     * @param array $options
     */
    public function __construct($url = null, $header = array(), $auth = array(), $options = array())
    {
        $this->url = $url;
        $this->header = $header;
        $this->auth = $auth;
        $this->options = $options;
    }

    /**
     * function setHeader
     * @param array $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * function setAuth
     * @param array $auth
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;
    }

    /**
     * function setOptions
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $header
     * @param array $data
     * @param array $auth
     * @param bool $forceInit
     * @return mixed
     * @throws \Exception
     */
    public function executeQuery($url, $method = 'GET', $header = array(), $data = array(), $auth = array(), $forceInit = false)
    {

        if (true === $forceInit) {
            $this->close(); // close previous channel
        }

        if (null === $this->curl) {
            $this->curl = curl_init();
        }

        if ($method == 'GET') {
            $url .= strpos($url, '?') > -1 ? '&' : '?';
            $url .= http_build_query($data);
        }

        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        if (!empty($auth)) {
            curl_setopt($this->curl, CURLOPT_HTTPAUTH, $auth['CURLOPT_HTTPAUTH']);
            curl_setopt($this->curl, CURLOPT_USERPWD, $auth['username'] . ':' . $auth['password']);
        }

        if (is_array($this->options)) {
            foreach ($this->options as $option => $value) {
                curl_setopt($this->curl, $option, $value);
            }
        }

        if ($method == 'POST') {
            curl_setopt($this->curl, CURLOPT_POST, true);
            if (!empty($data)) {
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));
            } else {
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, array());
            }
        } elseif ($method == 'PUT') {
            curl_setopt($this->curl, CURLOPT_PUT, true);
            if (!empty($data)) {
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));
            } else {
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, array());
            }
        } elseif ($method == 'DELETE') {
            curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            if (!empty($data)) {
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));
            } else {
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, array());
            }
        }

        $content = curl_exec($this->curl);

        if (FALSE === $content)
            throw new \Exception(curl_error($this->curl), curl_errno($this->curl));

        return $content;
    }

    /**
     * function call
     * @param string $method
     * @param string $segment
     * @param array $data
     * @return array
     */
    private function call($method, $segment, $data = array())
    {
        $query_str = parse_url($this->url, PHP_URL_QUERY);
        $this->url = str_replace('?'.$query_str, '', $this->url);
        return $this->executeQuery($this->url . '/' . $segment.'?'.$query_str, $method, $this->header, $data, $this->auth);
    }

    /**
     * function get
     * @param string $segment
     * @param array $data
     * @return array
     */
    public function get($segment, $data = array())
    {
        return $this->call('GET', $segment, $data);
    }

    /**
     * function post
     * @param string $segment
     * @param array $data
     * @return array
     */
    public function post($segment, $data)
    {
        return $this->call('POST', $segment, $data);
    }

    /**
     * function put
     * @param string $segment
     * @param array $data
     * @return array
     */
    public function put($segment, $data)
    {
        return $this->call('PUT', $segment, $data);
    }

    /**
     * function delete
     * @param string $segment
     * @param array $data
     * @return array
     */
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

    public function close()
    {
        if (null !== $this->curl) {
            curl_close($this->curl);
        }

        $this->curl = null;
    }


}
