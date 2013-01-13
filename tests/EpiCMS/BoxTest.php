<?php

use EpiCMS\Box;

class EpiCMS_BoxTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        Box::driver(new DriverMock);
    }

    public function testCreateInstance() {
        $box = Box::undefined('namespace:test-1');
        $this->assertInstanceOf('EpiCMS\Box', $box);
    }

    public function testCreateInstanceInvalidType() {
        $this->setExpectedException('\InvalidArgumentException', 'invalid box type: \'\EpiCMS\Box::NONEXISTSBOXTYPE\'');
        $box = Box::nonExistsBoxType('namespace:test-1');
    }

    public function testSetDriver() {
        Box::driver(new DriverMock);
        $this->assertInstanceOf('EpiCMS\Driver', Box::driver());
    }

    public function testGetKey() {
        $box = Box::undefined('namespace:test-1', 'test3');
        $this->assertEquals('namespace:test-1', $box->key());
    }

    public function testGetValue() {
        $box = Box::undefined('namespace:test-1', 'test3');
        $this->assertEquals('test3', $box->value());
    }

    public function testGetType() {
        $box = Box::undefined('namespace:test-1', 'test3');
        $this->assertEquals('undefined', $box->type());
    }

    public function testGetHash() {
        $box = Box::undefined('namespace:test-1');
        $this->assertEquals('57fff4d8afd10c02f6913a9523130a67', $box->hash());
    }

    public function testLoadValueEmptyData() {
        $box = Box::undefined('namespace:test-noexists-1');
        $this->assertEquals(null, $box->value());
    }

    public function testLoadValue() {
        $box = Box::undefined('namespace:test-1');
        $this->assertEquals('test', $box->value());
    }

    public function testToString() {
        $box = Box::undefined('namespace:test-1');
        $this->assertEquals('test', $box->__toString());
    }

    public function testSetValue() {
        $box = Box::undefined('namespace:test-1');
        $box->value('test-2');
        $this->assertEquals('test-2', $box->value());
    }

    public function testSaveValue() {
        $box = Box::undefined('namespace:test-1');
        $box->value('test-3');
        $box->save();
        $this->assertEquals(array('_type' => 'undefined', 'value'=>'test-3'), Box::driver()->get('namespace:test-1'));
    }

    public function testDeleteKey() {
        $box = Box::undefined('namespace:test-1');
        $box->remove();
        $this->assertEquals(null, Box::driver()->get('namespace:test-1'));
    }

}