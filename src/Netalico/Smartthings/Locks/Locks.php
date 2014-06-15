<?php

namespace Netalico\Smartthings;

use \anlutro\cURL\cURL;

class Locks {

	protected $baseURL = "https://graph.api.smartthings.com";

	protected $smartthings;

	protected $curl;

	public function __construct(cURL $curl)
	{	
		$this->curl = new cURL;
	} 

	public function setSmartthings(Smartthings $smartthings)
	{
		$this->smartthings = $smartthings;

		return $this;
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

		return $this;
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

		return $this;
	}

}