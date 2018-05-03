<?php
namespace AdsCampaign\Controller\Web;

use AdsCampaign\View\View\View;
use AdsCampaign\View\View\ClientInfo;
use AdsCampaign\Exception\ViewException;
use AdsCampaign\Controller\Controller\BaseController;


use AdsCampaign\Detect;

class DeviceController extends BaseController
{
	/**
    * Shows the device info  
    *
    * @url GET /
    * 
    */
    public function getHomePage() 
    {
        try{
            $clientInfo = new ClientInfo();
            $view = new View('home');
            $view->assign( "data", $clientInfo->getInfo());
        }catch (ViewException $e){
            return $this->error($e,404);
        }
    }
}



?>