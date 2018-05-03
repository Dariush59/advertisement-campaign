<?php
namespace AdsCampaign\Controller\Api;

use AdsCampaign\Controller\Controller\BaseController;
use \Jacwright\RestServer\RestException;
use AdsCampaign\Exception\DbException;
use AdsCampaign\Model\Advertiser;
use InvalidArgumentException;

class AdvertiserController extends BaseController
{
    private $advertiser;

    function __construct(){
        $this->advertiser = new Advertiser();
    }

    /**
     * Gets the advertiser by id
     *
     * @url GET /api/advertisers/$id
     */
    public function getAdvertiser(int $id) : array
    {
        try{
            return $this->advertiser->getAdvertiser($id);
        }catch (Throwable $e){
            return $this->error($e);
        }catch (InvalidArgumentException $e){
            return $this->error($e, 404);
        }
        
    }

    /**
     * Saves or updates the given data to the advertiser table
     *
     * @url POST /api/advertisers
     * @url PUT /api/advertisers/$id
     */
    public function saveAdvertiser(int $id = null, \stdClass $data) : array
    {
        try{
            return $this->advertiser->save($id, $data);  
        }catch (Throwable $e){
            return $this->error($e);
        }catch (InvalidArgumentException $e){
            return $this->error($e, 404);
        }catch (DbException $e){
            return $this->error($e, 404);
        }
        
    }

    /**
     * Gets advertiser list
     *
     * @url GET /api/advertisers
     */
    public function listAdvertiser() : array
    {
        try{
            return $this->advertiser->list(); 
        }catch (Throwable $e){
            return $this->error($e);
        }
        
    }


    /**
     * Delete advertiser by id
     *            
     * @url DELETE /api/advertisers/$id
     */
    public function deleteAdvertiser(int $id) : array
    {
        try{
            return $this->advertiser->delete($id);
        }catch (Throwable $e){
            return $this->error($e);
        }catch (InvalidArgumentException $e){
            return $this->error($e, 404);
        }catch (DbException $e){
            return $this->error($e, 404);
        }

    }

    /**
     * Gets advertisers and their campaigns
     *            
     * @url GET /api/advertisers/campaigns
     */
    public function getAdvertiserAndCampaigns() : array
    {
        try{
            return $this->advertiser->advertiserAndCampaigns();
        }catch (Throwable $e){
            return $this->error($e);
        }
    }

    /**
     * Gets an advertiser and its Ads
     *            
     * @url GET /api/advertisers/$id/ads
     */
    public function getAdvertiserAndAds(int $id) : array
    {
        try{
            return $this->advertiser->advertiserAndAds($id);
        }catch (Throwable $e){
            return $this->error($e);
        }catch (InvalidArgumentException $e){
            return $this->error($e, 404);
        }
    }

    /**
     * Gets an advertiser and its Ads when a total number of Ads is more than the given number
     *            
     * @url GET /api/advertisers/$id/ads/$limit
     */
    public function getAdvertiserAndAdsIsMoreThan(int $id, int $limit) : array
    {
        try{
            return $this->advertiser->advertiserAndAdsIsMoreThan($id, $limit);
        }catch (Throwable $e){
            return $this->error($e);
        }catch (InvalidArgumentException $e){
            return $this->error($e, 404);
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
