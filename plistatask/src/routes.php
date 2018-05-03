<?php 
use AdsCampaign\Route\RouteBase\Route;
use AdsCampaign\Route\Api;
use AdsCampaign\Route\Web;


$route = new route();


if ($route->isApi()) {
	(new Api())->getControllers();
}

if ($route->isWeb()) {
	(new Web())->getControllers();
}
