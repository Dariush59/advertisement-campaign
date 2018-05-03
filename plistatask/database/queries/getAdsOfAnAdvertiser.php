<?php
require_once __DIR__ . '/../requirements/requirement.php';
require_once __DIR__ . '/../../src/AdsCampaign/Model/Advertiser.php';


use AdsCampaign\Model\Advertiser;

class AdsOfAnAdvertiser 
{
	public function getAdsOfAnAdvertiser($id, $limit)
	{
		try{
		    if (!isset($id) && empty($id)) 
		        throw new Exception("Please set Advertiser id on arg1.");
		    if (!isset($limit) && empty($limit)) 
		        throw new Exception("Please set number of limitation on arg2.");   


		    $advertiser = new Advertiser();
		    print_r($advertiser->advertiserAndAdsIsMoreThan($id, $limit));
		}catch (Throwable $e){
		    print_r(['erorr' => $e->getMessage()]);
		}
	}
}

list($arg1, $id) = explode('=', $argv[1]);
list($arg2, $limit) = explode('=', $argv[2]);
(new AdsOfAnAdvertiser())->getAdsOfAnAdvertiser($id, $limit);

die();
?>