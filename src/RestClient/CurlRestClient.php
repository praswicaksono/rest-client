<?php

namespace RestClient;

class CurlRestClient extends RestClient
{
	private $connectionTimeout;

	private $timeout;

	public function __construct($connectionTimeout = null, $timeout = null)
	{
		$this->connectionTimeout = $connectionTimeout;
		$this->timeout = $timeout;
	}

	public function executeQuery($url, $method = 'GET', $header = array(), $data = '')
	{
		$curl = curl_init();
    	curl_setopt($curl, CURLOPT_URL, $url);
    	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    	if ($method == 'POST') {
    		curl_setopt($curl, CURLOPT_POST, true);
    		if(!empty($data)) {
    			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    		}
    	} elseif ($method == 'PUT') {
    		curl_setopt($curl, CURLOPT_PUT, true);
        	if(!empty($data)) {
    			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    		}
    	} elseif ($method == 'DELETE') {
    		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
    		if(!empty($data)) {
    			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    		}
    	}

    	return curl_exec($curl);
	}

	public function getName()
	{
		return 'curl';
	}
}