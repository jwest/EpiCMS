<?php

use EpiCMS\Box;
use EpiCMS\Box\Text;

class EpiCMS_Box_TextTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        Box::driver(new DriverMock);
    }

    public function testCreateInstance() {
        $box = Box::text('namespace', 'test-1');
        $this->assertInstanceOf('\EpiCMS\Box\Text', $box);
    }

}