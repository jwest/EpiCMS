<?php

use EpiCMS\Box;

class EpiCMS_BoxTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        Box::driver(new DriverMock);
    }

    public function testCreateInstance() {
        $box = Box::text('namespace', 'test-1');
        $this->assertInstanceOf('EpiCMS\Box', $box);
    }

    public function testCreateInstanceInvalidType() {
        $this->setExpectedException('\InvalidArgumentException', 'invalid box type: \'\EpiCMS\Box::NONEXISTSBOXTYPE\'');
        $box = Box::nonExistsBoxType('namespace', 'test-1');
    }

    public function testCreateInstanceInvalidArguments() {
        $this->setExpectedException('\InvalidArgumentException', 'invalid parameters count');
        $box = Box::text('namespace');
    }

    public function testSetDriver() {
        Box::driver(new DriverMock);
        $this->assertInstanceOf('EpiCMS\Driver', Box::driver());
    }

    public function testLoadName() {
        $box = Box::text('namespace', 'test-1');
        $this->assertEquals('text:namespace:test-1', $box->key());
    }

    public function testLoadValueEmptyData() {
        $box = Box::text('namespace', 'test-noexists-1');
        $this->assertEquals(null, $box->value());
    }

    public function testLoadValue() {
        $box = Box::text('namespace', 'test-1');
        $this->assertEquals('test', $box->value());
    }

    public function testSetValue() {
        $box = Box::text('namespace', 'test-1');
        $box->value('test-2');
        $this->assertEquals('test-2', $box->value());
    }

    public function testSaveValue() {
        $box = Box::text('namespace', 'test-1');
        $box->value('test-3');
        $box->save();
        $this->assertEquals('test-3', Box::driver()->get('text:namespace:test-1'));
    }

    public function testDeleteKey() {
        $box = Box::text('namespace', 'test-1');
        $box->remove();
        $this->assertEquals(null, Box::driver()->get('text:namespace:test-1'));
    }

}