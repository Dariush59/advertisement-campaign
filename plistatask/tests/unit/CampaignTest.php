<?php

use PHPUnit\Framework\TestCase;
use AdsCampaign\Model\Campaign;

class CampaignTest extends TestCase
{
    protected $campaign;
    protected $stdClass;

    public function testClassExists()
    {
        $this->assertTrue(class_exists(Campaign::class));
    }

    public function setUp()
    {
        $this->campaign = new Campaign();
        $this->stdClass = new \stdClass();
    }

    public function testClassPropertyExists()
    {
        $this->assertTrue(property_exists(Campaign::class, 'conn'));
    }

    public function testGetCampaignMethods()
    {
        $stub = $this->createMock(Campaign::class);
        $stub->method('getCampaign')
             ->willReturn([]);
        $this->assertEquals([], $stub->getCampaign(1));
        $this->expectException(InvalidArgumentException::class);
        $this->campaign->getCampaign(0);
    }

    public function testSaveMethods()
    {
        $stub = $this->createMock(Campaign::class);
        $stub->method('save')
             ->willReturn([]);
        $this->assertEquals([], $stub->save(1, $this->stdClass));
        $this->expectException(InvalidArgumentException::class);
        $this->campaign->save(0, $this->stdClass);
    }

    public function testListMethods()
    {
        $stub = $this->createMock(Campaign::class);
        $stub->method('list')
             ->willReturn([]);
        $this->assertEquals([], $stub->list());
    }

    public function testDeleteMethods()
    {
        $stub = $this->createMock(Campaign::class);
        $stub->method('delete')
             ->willReturn([]);
        $this->assertEquals([], $stub->delete(1));
        $this->expectException(InvalidArgumentException::class);
        $this->campaign->delete(0);
    }

    public function testCampaignAndAdsMethods()
    {
        $stub = $this->createMock(Campaign::class);
        $stub->method('campaignAndAds')
             ->willReturn([]);
        $this->assertEquals([], $stub->campaignAndAds(1));
        $this->expectException(InvalidArgumentException::class);
        $this->campaign->campaignAndAds(0);
    }

    public function testCampaignAndNullAdsMethods()
    {
        $stub = $this->createMock(Campaign::class);
        $stub->method('campaignAndNullAds')
             ->willReturn([]);
        $this->assertEquals([], $stub->campaignAndNullAds());
    }
}

?>