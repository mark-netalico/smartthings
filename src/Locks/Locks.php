<?php

namespace Netalico\Smartthings;

class Locks {

	private $baseURL = "https://graph.api.smartthings.com";

	private $smartthings;

	public function __construct(Smartthings $smartthings)
	{
		$this->smartthings = $smartthings;
	}

	public function getLocks()
	{
		$requestUrl = $this->baseURL . "/api/smartapps/installations/" . $this->smartthings->getEndpoint() . "/lock";
		$curl = new \anlutro\cURL\cURL;
			$result = $curl->newRequest('GET', $requestUrl )
			    ->setHeader('content-type', 'application/json')
			    ->setHeader('Accept', 'json')
			    ->setHeader('Authorization', 'Bearer ' .  $this->smartthings->getAccessToken())
			    ->setOptions([CURLOPT_VERBOSE => true])
			    ->send();

			$switches = json_decode($result->body);

		return $switches;
	}

	public function getLock($lockId)
	{
		$requestUrl = $this->baseURL . "/api/smartapps/installations/" . $this->smartthings->getEndpoint() . "/lock/";
		$requestUrl .= $lockId;
		$curl = new \anlutro\cURL\cURL;
		$result = $curl->newJsonRequest('GET', $requestUrl, array() )
		    ->setHeader('content-type', 'application/json')
		    ->setHeader('Accept', 'json')
		    ->setHeader('Authorization', 'Bearer ' . $this->smartthings->getAccessToken())
		    ->setOptions([CURLOPT_VERBOSE => true])
		    ->send();

		$lock = json_decode($result->body);

		return $lock;
	}

	public function setLocked($lockId)
	{
		$requestUrl = $this->baseURL . "/api/smartapps/installations/" . $this->smartthings->getEndpoint() . "/lock/";
		$requestUrl .= $lockId;
		$curl = new \anlutro\cURL\cURL;
		$result = $curl->newJsonRequest('PUT', $requestUrl, array('command' => 'lock') )
		    ->setHeader('content-type', 'application/json')
		    ->setHeader('Accept', 'json')
		    ->setHeader('Authorization', 'Bearer ' . $this->smartthings->getAccessToken())
		    ->setOptions([CURLOPT_VERBOSE => true])
		    ->send();

		
	}

	public function setUnlocked($lockId)
	{
		$requestUrl = $this->baseURL . "/api/smartapps/installations/" . $this->smartthings->getEndpoint() . "/lock/";
		$requestUrl .= $lockId;
		$curl = new \anlutro\cURL\cURL;
		$result = $curl->newJsonRequest('PUT', $requestUrl, array('command' => 'unlock') )
		    ->setHeader('content-type', 'application/json')
		    ->setHeader('Accept', 'json')
		    ->setHeader('Authorization', 'Bearer ' . $this->smartthings->getAccessToken())
		    ->setOptions([CURLOPT_VERBOSE => true])
		    ->send();

	}

}