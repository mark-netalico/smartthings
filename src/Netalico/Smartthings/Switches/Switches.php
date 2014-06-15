<?php

namespace Netalico\Smartthings;

use \anlutro\cURL\cURL;

class Switches {

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

	public function getSwitches()
	{
		$requestUrl = $this->baseURL . "/api/smartapps/installations/" . $this->smartthings->getEndpoint() . "/switch";
		$curl = new \anlutro\cURL\cURL;
			$result = $curl->newRequest('get', $requestUrl )
			    ->setHeader('content-type', 'application/json')
			    ->setHeader('Accept', 'json')
			    ->setHeader('Authorization', 'Bearer ' .  $this->smartthings->getAccessToken())
			    ->setOptions([CURLOPT_VERBOSE => true])
			    ->send();

			$switches = json_decode($result->body);

		return $switches;
	}

	public function getSwitch($switchId)
	{
		$requestUrl = $this->baseURL . "/api/smartapps/installations/" . $this->smartthings->getEndpoint() . "/switch/";
		$requestUrl .= $switchId;
		$curl = new \anlutro\cURL\cURL;
		$result = $curl->newJsonRequest('GET', $requestUrl, array() )
		    ->setHeader('content-type', 'application/json')
		    ->setHeader('Accept', 'json')
		    ->setHeader('Authorization', 'Bearer ' . $this->smartthings->getAccessToken())
		    ->setOptions([CURLOPT_VERBOSE => true])
		    ->send();

		$switch = json_decode($result->body);

		return $switch;
	}

	public function setSwitchOn($switchId)
	{
		$requestUrl = $this->baseURL . "/api/smartapps/installations/" . $this->smartthings->getEndpoint() . "/switch/";
		$requestUrl .= $switchId;
		$curl = new \anlutro\cURL\cURL;
		$result = $curl->newJsonRequest('PUT', $requestUrl, array('command' => 'on') )
		    ->setHeader('content-type', 'application/json')
		    ->setHeader('Accept', 'json')
		    ->setHeader('Authorization', 'Bearer ' . $this->smartthings->getAccessToken())
		    ->setOptions([CURLOPT_VERBOSE => true])
		    ->send();

		return $this;
	}

	public function setSwitchOff($switchId)
	{
		$requestUrl = $this->baseURL . "/api/smartapps/installations/" . $this->smartthings->getEndpoint() . "/switch/";
		$requestUrl .= $switchId;
		$curl = new \anlutro\cURL\cURL;
		$result = $curl->newJsonRequest('PUT', $requestUrl, array('command' => 'off') )
		    ->setHeader('content-type', 'application/json')
		    ->setHeader('Accept', 'json')
		    ->setHeader('Authorization', 'Bearer ' . $this->smartthings->getAccessToken())
		    ->setOptions([CURLOPT_VERBOSE => true])
		    ->send();

		return $this;
	}

}