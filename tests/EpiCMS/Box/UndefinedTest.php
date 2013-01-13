<?php

use EpiCMS\Box;
use EpiCMS\Box\Undefined;

class EpiCMS_Box_UndefinedTest_as extends PHPUnit_Framework_TestCase {

    public function setUp() {
        Box::driver(new DriverMock);
    }

    public function testCreateInstance() {
        $box = Box::undefined('namespace:test-1');
        $this->assertInstanceOf('\EpiCMS\Box\Undefined', $box);
    }

    public function testPrepareTextBox() {
        $box = Box::undefined('namespace:test-1')->type('text');
        $this->assertInstanceOf('\EpiCMS\Box\Text', $box);
    }

    public function testCheckHash() {
        $box = Box::undefined('namespace:test-1');
        $this->assertEquals('57fff4d8afd10c02f6913a9523130a67', $box->hash());
    }

    public function testPrepareTextBoxAndCheckHash() {
        $box = Box::undefined('namespace:test-1')->type('text');
        $this->assertEquals('57fff4d8afd10c02f6913a9523130a67', $box->hash());
    }

}