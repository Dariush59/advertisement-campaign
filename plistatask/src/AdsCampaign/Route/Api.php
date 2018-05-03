<?php
namespace AdsCampaign\Route;

use AdsCampaign\Route\RouteBase\RouteBase;
use AdsCampaign\Controller\Api\AdvertiserController;
use AdsCampaign\Controller\Api\CampaignController;
use AdsCampaign\Controller\Api\AdController;

class Api extends RouteBase
{
	function __construct()
	{
		parent::__construct();
		header( 'Content-Type: application/json' );
	}

	public function getControllers() : void
	{
		$this->server->addClass(AdvertiserController::class);	
		$this->server->addClass(CampaignController::class);
		$this->server->addClass(AdController::class);	
	}
}