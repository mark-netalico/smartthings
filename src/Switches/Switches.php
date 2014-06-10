<?php

namespace Netalico\Smartthings;

class Switches {

	private $smartthings;

	public function __construct(Smartthings $smartthings)
	{
		$this->smartthings = $smartthings;
	}

	public function getSwitches()
	{
		$requestUrl = "https://graph.api.smartthings.com/api/smartapps/installations/" . $this->smartthings->getEndpoint() . "/switch";
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

}