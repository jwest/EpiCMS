<?php

use EpiCMS\Box;

class EpiCMS_BoxTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        Box::driver(new DriverMock);
    }

    public function testCreateInstance() {
        $box = Box::undefined('namespace', 'test-1');
        $this->assertInstanceOf('EpiCMS\Box', $box);
    }

    public function testCreateInstanceInvalidType() {
        $this->setExpectedException('\InvalidArgumentException', 'invalid box type: \'\EpiCMS\Box::NONEXISTSBOXTYPE\'');
        $box = Box::nonExistsBoxType('namespace', 'test-1');
    }

    public function testCreateInstanceInvalidArguments() {
        $this->setExpectedException('\InvalidArgumentException', 'invalid parameters count');
        $box = Box::undefined('namespace');
    }

    public function testSetDriver() {
        Box::driver(new DriverMock);
        $this->assertInstanceOf('EpiCMS\Driver', Box::driver());
    }

    public function testPrepareInstance() {
        $box = Box::prepare('namespace:test-1', 'test3');
        $this->assertEquals('namespace:test-1', $box->key());
        $this->assertEquals('test3', $box->value());
    }

    public function testPrepareInvalidInstance() {
        $this->setExpectedException('\InvalidArgumentException', 'invalid key: \'namespacetest-1\'');
        Box::prepare('namespacetest-1');
    }

    public function testGetKey() {
        $box = Box::undefined('namespace', 'test-1');
        $this->assertEquals('namespace:test-1', $box->key());
    }

    public function testGetName() {
        $box = Box::undefined('namespace', 'test-1');
        $this->assertEquals('test-1', $box->name());
    }

    public function testGetNamespace() {
        $box = Box::undefined('namespace', 'test-1');
        $this->assertEquals('namespace', $box->ns());
    }

    public function testGetHash() {
        $box = Box::undefined('namespace', 'test-1');
        $this->assertEquals('317a1065efcb4ce92e250602b9557c85', $box->hash());
    }

    public function testLoadValueEmptyData() {
        $box = Box::undefined('namespace', 'test-noexists-1');
        $this->assertEquals(null, $box->value());
    }

    public function testLoadValue() {
        $box = Box::undefined('namespace', 'test-1');
        $this->assertEquals('test1', $box->value());
    }

    public function testToString() {
        $box = Box::undefined('namespace', 'test-1');
        $this->assertEquals('test1', $box->__toString());
    }

    public function testSetValue() {
        $box = Box::undefined('namespace', 'test-1');
        $box->value('test-2');
        $this->assertEquals('test-2', $box->value());
    }

    public function testSaveValue() {
        $box = Box::undefined('namespace', 'test-1');
        $box->value('test-3');
        $box->save();
        $this->assertEquals('test-3', Box::driver()->get('namespace:test-1'));
    }

    public function testDeleteKey() {
        $box = Box::undefined('namespace', 'test-1');
        $box->remove();
        $this->assertEquals(null, Box::driver()->get('namespace:test-1'));
    }

}