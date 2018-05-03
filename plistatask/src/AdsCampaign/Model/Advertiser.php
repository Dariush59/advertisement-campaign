<?php
namespace AdsCampaign\Model;

use Exception;
use InvalidArgumentException;
use AdsCampaign\Exception\DbException;
use AdsCampaign\Model\BaseModel\BaseModel;

class Advertiser extends BaseModel 
{
	public function getAdvertiser(int $id) : array
    {
        try{
            if (!$id) 
                throw new InvalidArgumentException("Invalid request.");
                
            $sql = "SELECT * FROM advertiser WHERE id=" . $id;
            $result = $this->conn->query($sql);
            $arr = [];
            if ($result->num_rows)
                while($row = $result->fetch_assoc())
                    $arr[] = $row;

            return ['data' => $arr];
        }catch (Throwable $e){
            throw new Exception($e->getMessage());
        }
    }

    public function save(int $id = null, \stdClass $data) : array
    {
        try{
            if (!isset($data->name)) 
                throw new InvalidArgumentException("Invalid request.");

            if (isset($id) && !$id) 
                throw new InvalidArgumentException("Invalid request.");

            if (!isset($id)) 
                $sql = "INSERT INTO advertiser (name) VALUES ('$data->name')";
            else
                $sql = "UPDATE advertiser SET name='$data->name' WHERE id=" . $id;
            

            if (!$this->conn->query($sql)) 
                throw new DbException($this->conn->error);
                
            return ['data'=>['id' => $id ?? $this->conn->insert_id]];
        }catch (Throwable $e){
            throw new Exception($e->getMessage());
        }
    }

    public function list() : array
    {
        try{    
            $sql = "SELECT * FROM advertiser";
            $result = $this->conn->query($sql);

            $arr = [];
            if ($result->num_rows) 
                while($row = $result->fetch_assoc()) 
                    $arr[] = $row;

            return ['data' => $arr];
        }catch (Throwable $e){
            throw new Exception($e->getMessage());
        }
    }

    public function delete(int $id) : array
    {
        try{
            if (!$id) 
                throw new InvalidArgumentException("Invalid request.");

            $sql = "DELETE advertiser,campaign,ads FROM advertiser
                INNER JOIN campaign 
                    ON campaign.advertiser_id = advertiser.id 
                INNER JOIN ads
                    ON ads.campaign_id = campaign.id 
                WHERE
                    advertiser.id = " . $id;

            if (!$this->conn->query($sql))
                throw new DbException($this->conn->error);

            if (isset($this->getCampaign($id)['data'][0])) {
                $sql = "DELETE  FROM advertiser WHERE id = " . $id;
                if (!$this->conn->query($sql))
                    throw new DbException($this->conn->error);
            }

            return ['data'=>['id' => $id]];

        }catch (Throwable $e){
            throw new Exception($e->getMessage());
        }
    }

    public function advertiserAndCampaigns() : array
    {
        try{
            $sql = "SELECT * FROM advertiser 
                    INNER JOIN campaign  
                        ON campaign.advertiser_id = advertiser.id";

            $result = $this->conn->query($sql);

            $data = [];
            if ($result->num_rows) 
                while($row = $result->fetch_assoc()) 
                    $data[] = $row;
               
            return ['data' => $data];
        }catch (Throwable $e){
            throw new Exception($e->getMessage());
        }
    }

    public function advertiserAndAds(int $id) : array
    {
        try{
            if (!$id) 
                throw new InvalidArgumentException("Invalid request.");

            $sql = "SELECT * FROM advertiser
                INNER JOIN campaign 
                    ON campaign.advertiser_id = advertiser.id
                INNER JOIN ads
                    ON ads.campaign_id = campaign.id
                WHERE advertiser.id = $id";

            $result = $this->conn->query($sql);

            $data = [];
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
            return ['data' => $data];
        }catch (Throwable $e){
            throw new Exception($e->getMessage());
        }
    }

    public function advertiserAndAdsIsMoreThan(int $id, int $limit) : array
    {
        try{
            if (!$id) 
                throw new InvalidArgumentException("Invalid request.");
            
            $sql = "SELECT *
                    FROM ads 
                    JOIN campaign 
                        ON ads.campaign_id = campaign.id 
                    JOIN advertiser ON campaign.advertiser_id = advertiser.id   
                    WHERE campaign.id 
                        in 
                        (SELECT ads.campaign_id FROM ads   
                            JOIN campaign 
                                ON ads.campaign_id = campaign.id    
                            WHERE campaign.advertiser_id = $id   
                            GROUP BY ads.campaign_id 
                                HAVING count(*) > $limit
                        )
                    -- (SELECT campaign_id FROM ads GROUP BY campaign_id HAVING COUNT(campaign_id) >=50)";

            $result = $this->conn->query($sql);

            $data = [];
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
            return ['data' => $data];
        }catch (Throwable $e){
            throw new Exception($e->getMessage());
        }
    }
}