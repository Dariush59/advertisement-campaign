<?php

use PHPUnit\Framework\TestCase;
use AdsCampaign\Model\Ad;

class AdTest extends TestCase
{
    protected $ad;
    protected $stdClass;

    public function testClassExists()
    {
        $this->assertTrue(class_exists(Ad::class));
    }

    public function setUp()
    {
        $this->ad = new Ad();
        $this->stdClass = new \stdClass();
    }

    public function testClassPropertyExists()
    {
        $this->assertTrue(property_exists(Ad::class, 'conn'));
    }

    public function testGetAdMethods()
    {
        $stub = $this->createMock(Ad::class);
        $stub->method('getAd')
             ->willReturn([]);
        $this->assertEquals([], $stub->getAd(1));
        $this->expectException(InvalidArgumentException::class);
        $this->ad->getAd(0);
    }

    public function testSaveMethods()
    {
        $stub = $this->createMock(Ad::class);
        $stub->method('save')
             ->willReturn([]);
        $this->assertEquals([], $stub->save(1, $this->stdClass));
        $this->expectException(InvalidArgumentException::class);
        $this->ad->save(0, $this->stdClass);
    }

    public function testListMethods()
    {
        $stub = $this->createMock(Ad::class);
        $stub->method('list')
             ->willReturn([]);
        $this->assertEquals([], $stub->list());
    }

    public function testDeleteMethods()
    {
        $stub = $this->createMock(Ad::class);
        $stub->method('delete')
             ->willReturn([]);
        $this->assertEquals([], $stub->delete(1));
        $this->expectException(InvalidArgumentException::class);
        $this->ad->delete(0);
    }
}

?>