<?php

namespace Netalico\Smartthings;

use \anlutro\cURL\cURL;

class Smartthings {

	protected $baseURL = "https://graph.api.smartthings.com";

	protected $oauthUrl;

	protected $endpoint;

	protected $clientId;

	protected $clientSecret;

	protected $accessToken = null;

	protected $accessCode;

	protected $redirectUri;

	protected $switches;

	protected $curl;

	public function __construct(cURL $curl)
	{	
		$this->curl = new cURL;
	} 

	public function getSmartthings()
	{
		return $this;
	}

	public function getOauthUrl() 
	{
		// TODO: return errors if clientId and RedirectUri not set

		return $this->baseURL . "/oauth/authorize?response_type=code&client_id=" . $this->clientId . "&scope=app&redirect_uri=" . urlencode($this->redirectUri);
	}

	public function setClientId($clientId)
	{
		$this->clientId = $clientId;

		return $this;
	}

	public function setClientSecret($clientSecret)
	{
		$this->clientSecret = $clientSecret;

		return $this;
	}

	public function setRedirectUri($redirectUri)
	{
		$this->redirectUri = $redirectUri;

		return $this;
	}

	public function setAccessToken($accessToken)
	{
		$this->accessToken = $accessToken;

		return $this;
	}

	public function getAccessToken()
	{
		return $this->accessToken;
	}

	public function setAccessCode($accessCode)
	{
		$this->accessCode = $accessCode;

		return $this;
	}

	public function setEndpoint($endpoint)
	{
		$this->endpoint = $endpoint;

		return $this;
	}

	public function getEndpoint()
	{
		return $this->endpoint;
	}

	public function requestAccessToken()
	{
		// TODO: return errors if clientId, RedirectUri, ClientSecret, and Code not set

		$authUrl = "https://graph.api.smartthings.com/oauth/token?grant_type=authorization_code&";
		$authUrl .= "client_id=" . $this->clientId;
		$authUrl .= "&client_secret=" . $this->clientSecret;
		$authUrl .= "&scope=app";
		$authUrl .= "&code=" . $this->accessCode;
		$authUrl .= "&redirect_uri=" . urlencode($this->redirectUri);

		
		$response = $this->curl->get($authUrl);

		$tokenData = json_decode($response);

		if (isset($tokenData->access_token)) {
			$this->setAccessToken($tokenData->access_token);
		}
		else
		{
			// TODO: send exception
		}
	}

}