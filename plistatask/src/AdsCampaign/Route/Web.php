<?php
namespace AdsCampaign\Route;

use AdsCampaign\Route\RouteBase\RouteBase;
use AdsCampaign\Controller\Web\DeviceController;

class Web extends RouteBase
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getControllers() : void
	{
		$this->server->addClass(DeviceController::class);
	}
}