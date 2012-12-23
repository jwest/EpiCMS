<?php

use EpiCMS\Box;
use EpiCMS\Boxes;

class EpiCMS_BoxesTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        Box::driver(new DriverMock);
    }

    public function testCreateInstance() {
        $collection = new Boxes('namespace');
        $this->assertInstanceOf('EpiCMS\Boxes', $collection);
    }

    public function testLoadEmptyNamespaces() {
        $collection = new Boxes('namespaceEmpty');
        foreach ($collection as $box) {
            $this->fail();
        }
    }

    public function testLoadNamespacesCheckCount() {
        $this->assertEquals(3, count(new Boxes('namespace2')));
    }

    public function testLoadNamespacesInstanceOfBox() {
        foreach (new Boxes('namespace') as $box)
            $this->assertInstanceOf('EpiCMS\Box\Undefined', $box);
    }

}