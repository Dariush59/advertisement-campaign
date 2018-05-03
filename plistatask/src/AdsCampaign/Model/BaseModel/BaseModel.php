<?php
namespace AdsCampaign\Model\BaseModel;

use Exception; 
class BaseModel extends AbstractBaseModel
{  
	function __construct()
	{
		parent::__construct();
		$this->setDatabaseConnection();
	}

	public function setDatabaseConnection() : void
    {
    	mysqli_select_db($this->conn, $GLOBALS['config']['dbname']);
    }
}
?>