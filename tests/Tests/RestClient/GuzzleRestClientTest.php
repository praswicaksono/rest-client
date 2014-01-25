<?php

namespace Test\RestClient;

use RestClient\GuzzleRestClient;

class GuzzleRestClientTest extends \PHPUnit_Framework_TestCase
{
	protected $guzzle;

	protected function setUp()
	{
		$this->guzzle = new GuzzleRestClient();
	}

	public function testGetWebsite()
	{
		$this->assertEquals('<!doctype html>', substr($this->guzzle->executeQuery('http://www.google.com'), 0, 15));
	}

	public function testGetName()
	{
		$this->assertEquals('guzzle', $this->guzzle->getName());
	}
}