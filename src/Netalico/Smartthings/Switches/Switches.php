<?php

namespace Netalico\Smartthings;

class Switches {

	private $baseURL = "https://graph.api.smartthings.com";

	private $smartthings;

	public function __construct()
	{
		// $this->smartthings = $smartthings;
	}

	public function setSmartthings(Smartthings $smartthings)
	{
		$this->smartthings = $smartthings;
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
	}

}