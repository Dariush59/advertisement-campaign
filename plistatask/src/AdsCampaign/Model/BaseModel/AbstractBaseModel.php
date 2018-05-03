<?php
namespace AdsCampaign\Model\BaseModel;

abstract class AbstractBaseModel 
{
	protected $conn;

    abstract protected function setDatabaseConnection();
    
	function __construct() {
        $this->setMySQLConnection();
    }

    private function setMySQLConnection()
    {
        try{
            $conn = new \mysqli($GLOBALS['config']['host'], $GLOBALS['config']['username'], $GLOBALS['config']['password']);//, $GLOBALS['config']['dbname']
            if ($conn->connect_error) {
                throw new Exception("Connection failed: " . $conn->connect_error);
                exit();
            } 
            $this->conn = $conn;

        }catch (Throwable $e){
            throw new Exception($e->getMessage());
        }
    }

    function __destruct() {
        $this->conn->close();
    }
}
?>