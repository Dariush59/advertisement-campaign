<?php 
namespace AdsCampaign\Controller\Api;

use AdsCampaign\Model\Ad;
use AdsCampaign\Exception\DbException;
use \Jacwright\RestServer\RestException;
use AdsCampaign\Controller\Controller\BaseController;

class AdController extends BaseController
{ 
    private $ad;
    
    function __construct(){
        $this->ad = new Ad();
    }

    /**
     * Gets the Ads by id 
     *
     * @url GET /api/ads/$id
     * 
     */
    public function getAd(int $id) : array
    {
        try{
            return $ad->getAd($id);
        }catch (Throwable $e){
            return $this->error($e);
        }catch (InvalidArgumentException $e){
            return $this->error($e, 404);
        }
    }

    /**
     * Saves an ad to the database
     *
     * @url POST /api/ads
     * @url PUT /api/ads/$id
     */
    public function saveBanner(int $id = null, $data) : array
    {
        try{
            return $this->ad->save($id, $data);
        }catch (Throwable $e){
            return ['message'=>$e];
            // return $this->error($e);
        }catch (InvalidArgumentException $e){
            return $this->error($e, 404);
        }catch (DbException $e){
            return $this->error($e, 404);
        }
    }

    /**
     * Gets ad list
     *
     * @url GET /api/ads
     */
    public function listAds() : array
    {
        try{
            return $this->ad->list();
        }catch (Throwable $e){
            return $this->error($e);
        }
    }


    /**
     * Delete ad by id
     *            
     * @url DELETE /api/ads/$id
     */
    public function deleteAd(int $id) : array
    {
        try{
            return $this->ad->delete($id);
        }catch (Throwable $e){
            return $this->error($e);
        }catch (InvalidArgumentException $e){
            return $this->error($e, 404);
        }catch (DbException $e){
            return $this->error($e, 404);
        }
    }


    /**
     * Throws an error
     * 
     * @url GET api/error
     */
    public function throwError() {
        throw new RestException(401, "Empty password not allowed");
    }
}
