<?php
namespace AdsCampaign\Route\RouteBase;

class Route 
{
	private  $uri = false;
	function __construct()
	{
		if ( isset( $_SERVER['REQUEST_URI']  )){
			$this->uri = ltrim($_SERVER['REQUEST_URI'], '/');
		} 

	}

	public function getUriStr() : string
	{
		return $this->uri;
	}

	public function getFirstUri() : string
	{
		return explode('/', $this->uri)[0];
	}

	public function isApi() : bool
	{
		return $this->getFirstUri() === 'api' ;
	}

	public function isWeb() : bool
	{
		return  $this->getFirstUri() !== 'api';
	}
}