<?php
namespace AdsCampaign\Controller\Api;

use InvalidArgumentException;
use AdsCampaign\Model\Campaign;
use AdsCampaign\Exception\DbException;
use \Jacwright\RestServer\RestException;
use AdsCampaign\Controller\Controller\BaseController;

class CampaignController extends BaseController
{
    private $campaign;

    function __construct(){
        $this->campaign = new Campaign();
    }
    /**
     * Gets the campaign by id
     *
     * @url GET /api/campaigns/$id
     */
    public function getCampaign(int $id) : array
    {
        try{
            return $this->campaign->getCampaign($id);
        }catch (Throwable $e){
            return $this->error($e);
        }catch (InvalidArgumentException $e){
            return $this->error($e, 404);
        }
    }

    /**
     * Saves a user to the database
     *
     * @url POST /api/campaigns
     * @url PUT /api/campaigns/$id
     */
    public function saveCampaign(int $id = null, $data) : array
    {
        try{
            return $this->campaign->save($id, $data);  
        }catch (Throwable $e){
            return $this->error($e);
        }catch (InvalidArgumentException $e){
            return $this->error($e, 404);
        }catch (DbException $e){
            return $this->error($e, 404);
        }
    }

    /**
     * Gets campaign list
     *
     * @url GET /api/campaigns
     */
    public function listCampaign() : array
    {
        try{
            return $this->campaign->list(); 
        }catch (Throwable $e){
            return $this->error($e);
        }
        
    }

    /**
     * Delete campaign by id
     *            
     * @url DELETE /api/campaigns/$id
     */
    public function deleteCampaign(int $id) : array
    {
        try{
            return $this->campaign->delete($id);
        }catch (Throwable $e){
            return $this->error($e);
        }catch (InvalidArgumentException $e){
            return $this->error($e, 404);
        }catch (DbException $e){
            return $this->error($e, 404);
        }
    }

    /**
     * Gets campaign by id and shows all its ads
     *            
     * @url GET /api/campaigns/$id/ads
     */
    public function getCampaignAndAds(int $id) : array
    {
        try{
            return $this->campaign->campaignAndAds($id);
        }catch (Throwable $e){
            return $this->error($e);
        }catch (InvalidArgumentException $e){
            return $this->error($e, 404);
        }
    }

    /**
     * Gets campaigns which doen't have any ads
     *            
     * @url GET /api/campaigns/with/no/ads
     */
    public function getCampaignAndNullAds() : array
    {
        try{
            return $this->campaign->campaignAndNullAds($id);
        }catch (Throwable $e){
            return $this->error($e);
        }
    }


    /**
     * Throws an error
     * 
     * @url GET /api/error
     */
    public function throwError() {
        throw new RestException(401, "Empty password not allowed");
    }
}
