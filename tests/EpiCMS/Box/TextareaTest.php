<?php

use EpiCMS\Box;
use EpiCMS\Box\Text;

class EpiCMS_Box_TextareaTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        Box::driver(new DriverMock);
    }

    public function testCreateInstance() {
        $box = Box::textarea('namespace', 'test-1');
        $this->assertInstanceOf('\EpiCMS\Box\Textarea', $box);
    }

    public function testObjectMigrationType() {
    	$box = Box::textarea('page:main');
        $this->assertEquals('textarea', $box->type());	
    }

}