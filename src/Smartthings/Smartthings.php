<?php

namespace Netalico\Smartthings;

// use Netalico\Smartthings\Switches;



class Smartthings {

	private $baseURL = "https://graph.api.smartthings.com";

	private $oauthUrl;

	private $endpoint;

	private $clientId;

	private $clientSecret;

	private $accessToken = null;

	private $accessCode;

	private $redirectUri;

	private $switches;

	public function __construct()
	{} 

	public function getOauthUrl() 
	{
		// TODO: return errors if clientId and RedirectUri not set

		return $this->baseURL . "/oauth/authorize?response_type=code&client_id=" . $this->clientId . "&scope=app&redirect_uri=" . urlencode($this->redirectUri);
	}

	public function setClientId($clientId)
	{
		$this->clientId = $clientId;
	}

	public function setClientSecret($clientSecret)
	{
		$this->clientSecret = $clientSecret;
	}

	public function setRedirectUri($redirectUri)
	{
		$this->redirectUri = $redirectUri;
	}

	public function setAccessToken($accessToken)
	{
		$this->accessToken = $accessToken;
	}

	public function getAccessToken()
	{
		return $this->accessToken;
	}

	public function setAccessCode($accessCode)
	{
		$this->accessCode = $accessCode;
	}

	public function setEndpoint($endpoint)
	{
		$this->endpoint = $endpoint;
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

		$curl = new \anlutro\cURL\cURL;
		$response = $curl->get($authUrl);

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