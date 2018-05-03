<?php
require_once __DIR__ . '/../requirements/requirement.php';

use AdsCampaign\Model\BaseModel\AbstractBaseModel;


class Db extends AbstractBaseModel
{
    protected $dbname;

    public function setDBName($dbname){
        $this->dbname = $dbname;
    }

    public function createDb()
    {
        $sql = "CREATE DATABASE $this->dbname";
        if ($this->conn->query($sql) === TRUE) {
            echo "Database created successfully \n";
        } else {
            echo "Error creating database: " . $this->conn->error;
        }
    }
    public function setDatabaseConnection()
    {
        mysqli_select_db($this->conn, $this->dbname);//$GLOBALS['config']['dbname']
    }

    public function createAdvertiserTable()
    {
        $sql = "create table advertiser(
                    id INT NOT NULL AUTO_INCREMENT,
                    name VARCHAR(20) NOT NULL,
                    primary key (id)
                ) 
                COLLATE='utf8_general_ci'
                ENGINE=INNODB";  
             
        if(mysqli_query($this->conn, $sql)){  
            echo "Table created successfully \n";  
        } else {  
            echo "Table is not created successfully \n";  
        } 
    }

    public function createCampaignTable()
    {
        $sql = "create table campaign(
                    id INT NOT NULL AUTO_INCREMENT,
                    name VARCHAR(20) NOT NULL,
                    advertiser_id INT NOT NULL,
                    primary key (id),
                    FOREIGN KEY (advertiser_id) REFERENCES advertiser(id) ON DELETE CASCADE
                ) 
                COLLATE='utf8_general_ci'
                ENGINE=INNODB";  
             
        if(mysqli_query($this->conn, $sql)){  
            echo "Table created successfully \n";  
        } else {  
            echo "Table is not created \n";  
        }  
    }

    public function createAdsTable()
    {
           $sql = "create table ads (
                    id INT NOT NULL AUTO_INCREMENT,
                    title VARCHAR(60) NOT NULL,
                    text TEXT,
                    image VARCHAR(255),
                    sponsoredBy VARCHAR(60) NOT NULL,
                    trackingUrl VARCHAR(2083),
                    campaign_id INT NOT NULL,
                    primary key (id),
                    FOREIGN KEY (campaign_id) REFERENCES campaign(id) ON DELETE CASCADE
                ) 
                COLLATE='utf8_general_ci'
                ENGINE=INNODB";  
             
        if(mysqli_query($this->conn, $sql)){  
            echo "Table created successfully \n";  
        } else {  
            echo "Table is not created \n";  
        } 
    }
}

$dbname = $GLOBALS['config']['dbname'];
$db = new Db();
$db->setDBName($dbname);
$db->createDb();
$db->setDatabaseConnection();
$db->createAdvertiserTable();
$db->createCampaignTable();
$db->createAdsTable();

die();

?>