<?php

use EpiCMS\Box;
use EpiCMS\Box\Undefined;

class EpiCMS_Box_UndefinedTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        Box::driver(new DriverMock);
    }

    public function testCreateInstance() {
        $box = Box::undefined('namespace', 'test-1');
        $this->assertInstanceOf('\EpiCMS\Box\Undefined', $box);
    }

}