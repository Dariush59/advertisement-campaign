<?php
namespace AdsCampaign\Route\RouteBase;

use \Jacwright\RestServer\RestServer;

class RouteBase 
{
	protected $server;

	function __construct()
	{
		$this->server = new RestServer('dev');
	}

	function __destruct()
	{
		$this->server->handle();
	}
}

