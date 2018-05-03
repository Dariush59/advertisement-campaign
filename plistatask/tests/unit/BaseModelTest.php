<?php
use PHPUnit\Framework\TestCase;
use AdsCampaign\Model\BaseModel\BaseModel;

class BaseModelTest extends TestCase
{
	public function testsetDatabaseConnectionMethod()
    {
        $stub = $this->createMock(BaseModel::class);
        $stub->expects($this->any())
             ->method('setDatabaseConnection')
             ->will($this->returnValue(''));

        $this->assertEquals('',$stub->setDatabaseConnection());
    }
}


?>