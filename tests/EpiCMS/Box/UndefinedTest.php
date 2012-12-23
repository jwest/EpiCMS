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

    public function testPrepareTextBox() {
        $box = Box::undefined('namespace', 'test-1')->type('text');
        $this->assertInstanceOf('\EpiCMS\Box\Text', $box);
    }

    public function testCheckHash() {
        $box = Box::undefined('namespace', 'test-1');
        $this->assertEquals('317a1065efcb4ce92e250602b9557c85', $box->hash());
    }

    public function testPrepareTextBoxAndCheckHash() {
        $box = Box::undefined('namespace', 'test-1')->type('text');
        $this->assertEquals('317a1065efcb4ce92e250602b9557c85', $box->hash());
    }

}