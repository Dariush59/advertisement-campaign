<?php
namespace AdsCampaign\Controller;

trait ErrorHandler {
    function error($e, $status = null) : array
    { 
    	return ['erorr' => [
    		'message' => $e->getMessage(), 
    		'code' => $status ?? $e->getCode()
    	]];
    }
}
?>