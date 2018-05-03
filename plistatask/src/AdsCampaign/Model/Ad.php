<?php
namespace AdsCampaign\Model;

use AdsCampaign\Model\BaseModel\BaseModel;
use \Jacwright\RestServer\RestException;
use AdsCampaign\Exception\DbException;
use InvalidArgumentException;
use Exception; 

class Ad extends BaseModel 
{
	public function getAd(int $id) : array
    {
        try{
            if (!$id) 
                throw new InvalidArgumentException("Invalid request.");

            $sql = "SELECT * FROM ads WHERE id=" . $id;
            $result = $this->conn->query($sql);
            $arr = [];
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $arr[] = $row;
                }
            }
            return ['data' => $arr];
        }catch (Throwable $e){
            throw new Exception($e->getMessage());
        }
    }

    public function save(int $id = null, \stdClass $data) : array
    {
        if (!isset($data->title) 
            || !isset($data->sponsored_by) 
            || !isset($data->campaign_id)) 
                throw new InvalidArgumentException("Invalid request.");

        if (isset($id) && !$id) 
            throw new InvalidArgumentException("Invalid request.");
        try{
            if (!isset($id) ) {
                $sql = "INSERT INTO ads (
                            title, 
                            text, 
                            image, 
                            sponsoredBy, 
                            trackingUrl, 
                            campaign_id)
                        VALUES (
                            '$data->title', 
                            '$data->text', 
                            '$data->image', 
                            '$data->sponsored_by', 
                            '$data->tracking_url', 
                            '$data->campaign_id')";
            }else{
                $sql = "UPDATE ads 
                        SET 
                            title = '$data->title', 
                            text = '$data->text', 
                            image = '$data->image', 
                            sponsoredBy = '$data->sponsored_by', 
                            trackingUrl = '$data->tracking_url',
                            campaign_id =  '$data->campaign_id'
                    WHERE id=" . $id;
            }
     
            if (!$this->conn->query($sql))
                throw new DbException($this->conn->error);

            return ['data'=>['id' =>  $id ?? $this->conn->insert_id ]];
        }catch (Throwable $e){
            throw new Exception($e->getMessage());
        }
    }

    public function list() : array
    {
        try{
            $sql = "SELECT * FROM ads";
            $result = $this->conn->query($sql);
            $arr = [];
            if ($result->num_rows > 0) 
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

            $sql = "DELETE FROM ads WHERE id=" . $id;
            if (!$this->conn->query($sql)) 
                throw new DbException($this->conn->error);
            
            return ['data'=>['id' => $this->conn->insert_id]];
        }catch (Throwable $e){
            throw new Exception($e->getMessage());
        }
    }
}