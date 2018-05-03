<?php
require_once __DIR__ . '/../requirements/requirement.php';
require_once __DIR__ . '/../../src/AdsCampaign/Model/Campaign.php';

use AdsCampaign\Model\Campaign;

class AllNullCampaigns 
{
	public function getAllNullCampaigns()
	{
		try{
		    $campaign = new Campaign();
		    print_r($campaign->campaignAndNullAds());
		}catch (Throwable $e){
		    print_r(['erorr' => $e->getMessage()]);
		}
	}
}

(new AllNullCampaigns())->getAllNullCampaigns();

die();
?>