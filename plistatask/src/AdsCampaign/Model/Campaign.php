<?php
namespace AdsCampaign\Model;

use Exception;
use InvalidArgumentException;
use AdsCampaign\Exception\DbException;
use AdsCampaign\Model\BaseModel\BaseModel;

class Campaign extends BaseModel 
{

	public function getCampaign(int $id) : array
    {
        try{
            if (!$id) 
                throw new InvalidArgumentException("Invalid request.");

            $sql = "SELECT * FROM campaign WHERE id=" . $id;
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
                $sql = "INSERT INTO campaign (name, advertiser_id) 
                        VALUES ('$data->name', '$data->advertiser_id')";
            else
                $sql = "UPDATE campaign SET name='$data->name', advertiser_id='$data->advertiser_id' WHERE id=" . $id;

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
            $sql = "SELECT * FROM campaign";
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

            $sql = "DELETE campaign,ads FROM campaign
                INNER JOIN
                    ads ON ads.campaign_id = campaign.id 
                WHERE
                    campaign.id = " . $id;

            if (!$this->conn->query($sql))
                throw new Exception($this->conn->error);

            if (isset($this->getCampaign($id)['data'][0])) {
                $sql = "DELETE  FROM campaigns WHERE id = " . $id;
                if (!$this->conn->query($sql))
                    throw new DbException($this->conn->error);
            }

            return ['data'=>['id' => $id]];

        }catch (Throwable $e){
            throw new Exception($e->getMessage());
        }
    }

    public function campaignAndAds($id) : array
    {
        try{
            if (!$id) 
                throw new InvalidArgumentException("Invalid request.");

            $sql = "SELECT * FROM campaign
                INNER JOIN
                    ads ON ads.campaign_id = campaign.id
                WHERE campaign.id = $id
            ";
            $result = $this->conn->query($sql);

            $arr = [];
            $data = [];
            if ($result->num_rows) 
                while($row = $result->fetch_assoc()) 
                    $data[] = $row;
               
            return ['data' => $data];
        }catch (Throwable $e){
            throw new Exception($e->getMessage());
        }
    }

    public function campaignAndNullAds() : array
    {
        try{
            $sql = "SELECT 
                        campaign.id,
                        ads.campaign_id
                    FROM campaign 
                    LEFT JOIN ads
                        ON ads.campaign_id = campaign.id 
                    Where ads.campaign_id IS NULL";

            $result = $this->conn->query($sql);

            $arr = [];
            $data = [];
            if ($result->num_rows) 
                while($row = $result->fetch_assoc()) 
                    $data[] = $row;
               
            return ['data' => $data];
        }catch (Throwable $e){
            throw new Exception($e->getMessage());
        }
    }
}