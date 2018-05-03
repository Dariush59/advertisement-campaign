<?php

use PHPUnit\Framework\TestCase;
use AdsCampaign\Model\Advertiser;

class AdvertiserTest extends TestCase
{
    protected $advertiser;
    protected $stdClass;

    public function testClassExists()
    {
        $this->assertTrue(class_exists(Advertiser::class));
    }

    public function setUp()
    {
        $this->advertiser = new Advertiser;
        $this->stdClass = new \stdClass();
    }

    public function testClassPropertyExists()
    {
        $this->assertTrue(property_exists(Advertiser::class, 'conn'));
    }

    public function testGetAdvertiserMethods()
    {
        $stub = $this->createMock(Advertiser::class);
        $stub->method('getAdvertiser')
             ->willReturn([]);
        $this->assertEquals([], $stub->getAdvertiser(1));
        $this->expectException(InvalidArgumentException::class);
        $this->advertiser->getAdvertiser(0);
    }

    public function testSaveMethods()
    {
        $stub = $this->createMock(Advertiser::class);
        $stub->method('save')
             ->willReturn([]);
        $this->assertEquals([], $stub->save(1, $this->stdClass));
        $this->expectException(InvalidArgumentException::class);
        $this->advertiser->save(0, $this->stdClass);
    }

    public function testListMethods()
    {
        $stub = $this->createMock(Advertiser::class);
        $stub->method('list')
             ->willReturn([]);
        $this->assertEquals([], $stub->list());
    }

    public function testDeleteMethods()
    {
        $stub = $this->createMock(Advertiser::class);
        $stub->method('delete')
             ->willReturn([]);
        $this->assertEquals([], $stub->delete(1));
        $this->expectException(InvalidArgumentException::class);
        $this->advertiser->delete(0);
    }

    public function testAdvertiserAndCampaignsMethods()
    {
        $stub = $this->createMock(Advertiser::class);
        $stub->method('advertiserAndCampaigns')
             ->willReturn([]);
        $this->assertEquals([], $stub->advertiserAndCampaigns());
    }

    public function testAdvertiserAndAdsMethods()
    {
        $stub = $this->createMock(Advertiser::class);
        $stub->method('advertiserAndAds')
             ->willReturn([]);
        $this->assertEquals([], $stub->advertiserAndAds(1));
        $this->expectException(InvalidArgumentException::class);
        $this->advertiser->advertiserAndAds(0);
    }

    public function testAdvertiserAndAdsIsMoreThanMethods()
    {
        $stub = $this->createMock(Advertiser::class);
        $stub->method('advertiserAndAdsIsMoreThan')
             ->willReturn([]);
        $this->assertEquals([], $stub->advertiserAndAdsIsMoreThan(1, 50));
        $this->expectException(InvalidArgumentException::class);
        $this->advertiser->advertiserAndAdsIsMoreThan(0, 50);
    }
}

?>