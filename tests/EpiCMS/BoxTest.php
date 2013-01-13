<?php

use EpiCMS\Box;
use EpiCMS\View\Formatter\Plain;
use EpiCMS\View\Formatter\Editable;

class EpiCMS_BoxTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        Box::driver(new DriverMock);
    }

    public function testCreateInstance() {
        $box = Box::undefined('namespace:test-1');
        $this->assertInstanceOf('EpiCMS\Box', $box);
    }

    public function testCreateInstanceInvalidType() {
        $this->setExpectedException('\InvalidArgumentException', 'invalid box type: \'\EpiCMS\Box\NonExistsBoxType\'');
        $box = Box::nonExistsBoxType('namespace:test-1');
    }

    public function testSetDriver() {
        Box::driver(new DriverMock);
        $this->assertInstanceOf('EpiCMS\Driver', Box::driver());
    }

    public function testSetFormatter() {
        Box::formatter(new Plain);
        $this->assertInstanceOf('EpiCMS\View\Formatter', Box::formatter());   
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

    public function testToStringUseFormatter() {
        Box::formatter(new Editable);
        $box = Box::undefined('namespace:test-1');
        $this->assertEquals('<span class="editable" data-type="undefined" data-pk="57fff4d8afd10c02f6913a9523130a67">test</span>', $box->__toString());
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

    // public function testAsHtml() {
    //     $box = Box::undefined('namespace:test-1');
    //     $box->asHtml()
    // }

}