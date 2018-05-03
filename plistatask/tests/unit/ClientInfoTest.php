<?php
use PHPUnit\Framework\TestCase;
use AdsCampaign\View\View\ClientInfo;

class ClientInfoTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists(ClientInfo::class));
    }

    public function testGetInfoMethod()
    {
        $stub = $this->createMock(ClientInfo::class);
        $stub->method('getInfo')
             ->willReturn([]);
        $this->assertEquals([], $stub->getInfo());

    }
}
?>