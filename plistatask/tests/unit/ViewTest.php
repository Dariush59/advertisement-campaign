<?php
use PHPUnit\Framework\TestCase;
use AdsCampaign\View\View\View;
use AdsCampaign\Exception\ViewException;

class ViewTest extends TestCase
{
	public function testClassExists()
    {
        $this->assertTrue(class_exists(View::class));
    }

    public function testViewConstructor()
    {
    	$this->expectException(ViewException::class);
        $view = new View('home1');
    }

    public function testAssignMethod()
    {
    	$stub = $this->createMock(View::class);
        $stub->method('assign')
             ->willReturn('');
        $this->assertEquals('', $stub->assign( "data", []));
    }
}
?>
