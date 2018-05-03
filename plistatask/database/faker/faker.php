<?php
require_once __DIR__ . '/../requirements/requirement.php';
require_once __DIR__ . '/../../vendor/fzaninotto/Faker/src/autoload.php';

use AdsCampaign\Model\BaseModel\BaseModel;
use Faker\Factory;
use Faker\Generator;

class faker extends BaseModel
{
	private $faker;

	function __construct( Generator $faker)
	{
		parent::__construct();
		$this->faker = $faker;
	}

	public function create()
	{
		try {
			$this->conn->begin_transaction();
			for ($i=1; $i <= 10; $i++) {
				echo "Started to Creating an Advertiser $i \n";
				$this->setAdvertiser();
				for ($j=1; $j <= 10; $j++) { 
					echo "Started to Creating a Campaign $i-$j \n";
					$this->setCampaign($i);
					$campaign_ids = [];
					for ($y=1; $y <= 10 ; $y++) {
						echo "Started to Creating an Ads $i-$j-$y \n";
						$this->setAds($i*$j);
					}
				}
			}
			$this->conn->commit();
		} catch (Exception $e) {
			$this->conn->rollback();
			echo $e->getMessage();
		}
	}

	private function setAdvertiser()
	{		
		$sql = $this->getAdvertiserQuery($this->faker);
		$this->conn->query($sql);
	}

	private function setCampaign($max)
	{
		$advertiser_id = $this->faker->numberBetween(1, $max);
		$sql = $this->getCampaignQuery($this->faker, $advertiser_id);
		$this->conn->query($sql);
	}

	private function setAds($max)
	{
		$campaign_id = $this->faker->numberBetween( 1, $max);
		$sql = $this->getAdsQuery($this->faker, $campaign_id);
	 	$this->conn->query($sql);
	}

	private function getAdvertiserQuery(Generator $faker) : string
	{
		return "INSERT INTO advertiser (name) VALUES ('$faker->company')";
	}

	private function getCampaignQuery(Generator $faker, int $advertiser_id) : string
	{
		return "INSERT INTO campaign (name, advertiser_id) VALUES ('$faker->name', '$advertiser_id')";
	}

	private function getAdsQuery(Generator $faker, int $campaign_id) : string
	{
		return "INSERT INTO ads (
					title, 
					text, 
					image, 
					sponsoredBy, 
					trackingUrl, 
					campaign_id)
						VALUES (
							'$faker->catchPhrase',
						 	'$faker->text(100)', 
						 	'$faker->imageUrl(640, 480)', 
						 	'$faker->company', 
						 	'$faker->url', 
						 	'$campaign_id')";
	}
}

(new Faker(Factory::create()))->create();

die();