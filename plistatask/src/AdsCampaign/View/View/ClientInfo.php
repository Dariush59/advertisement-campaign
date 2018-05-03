<?php
namespace AdsCampaign\View\View;

use AdsCampaign\Exception\DetectException;
use AdsCampaign\Detect;

class ClientInfo 
{
	public function getInfo() : array
    {
        try{
            $device = false;
            if (Detect::isMobile()) 
                $device = "Mobil";

            if (Detect::isPhone()) 
                $device = "Phone";

            if (Detect::isTablet()) 
                $device = "Tablet";

            if (Detect::isComputer()) 
                $device = "Computer";
            
            $data['detection'] = [
                "davice" => $device,
                "os" => Detect::os(),
                "browser" => Detect::browser(),
                "ip" => Detect::ip(),
                "host_name" => Detect::ipHostname(),
                "organisation" => Detect::ipOrg(),
                "brand" => Detect::brand(),
                "coutry" => Detect::ipCountry()
            ];

            return $data;

        }catch(Throwable $e){
            throw new DetectException("Detect Exception:" . $e->getMessage());
        }
    }
}