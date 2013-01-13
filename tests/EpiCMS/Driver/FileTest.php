<?php

use EpiCMS\Driver\File;

class EpiCMS_Driver_FileTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        file_put_contents('tests/data/storage.dat', serialize(array(
            'key1' => '{"value":"value1"}',
            'key2' => '{"value":"value2"}',
            'key3-test' => '{"value":"value3"}',
            'key4-test2' => '{"value":"value4"}',
            'key5-test3' => '{"value":"value5"}',
        )));
    }

    public function testCreateInstance() {
        $driver = new File('tests/data/storage.dat');
        $this->assertInstanceOf('EpiCMS\Driver\File', $driver);
    }

    public function testCreateInvalidInstance() {
        $this->setExpectedException('\InvalidArgumentException', 'invalid path: \'/nonExists/path.dat\'');
        $driver = new File('/nonExists/path.dat');
    }

    public function testLoadDataFromFile() {
        $driver = new File('tests/data/storage.dat');
        $dump = $driver->dump();
        $this->assertArrayHasKey('key1', $dump);
        $this->assertEquals('value1', $dump['key1']->value);
    }

    public function testGetOneNonExistsItem() {
        $driver = new File('tests/data/storage.dat');
        $this->assertEquals(null, $driver->get('keyNonExists'));
    }

    public function testGetOneItem() {
        $driver = new File('tests/data/storage.dat');
        $this->assertEquals('value1', $driver->get('key1')->value);
    }

    public function testSetItem() {
        $driver = new File('tests/data/storage.dat');
        $driver->set('key1', array('value'=>'value-test'));
        $driver = new File('tests/data/storage.dat');
        $this->assertEquals('value-test', $driver->get('key1')->value);
    }

    public function testCreateItem() {
        $driver = new File('tests/data/storage.dat');
        $driver->set('key2', array('value' => 'value-test'));
        $driver = new File('tests/data/storage.dat');
        $this->assertEquals('value-test', $driver->get('key2')->value);
        $this->assertCount(5, $driver->dump());
    }

    public function testDeleteItem() {
        $driver = new File('tests/data/storage.dat');
        $driver->del('key1');
        $driver = new File('tests/data/storage.dat');
        $this->assertCount(4, $driver->dump());
    }

    public function testGetAllWithPatternFirst() {
        $driver = new File('tests/data/storage.dat');
        $this->assertCount(5, $driver->search('key*'));
    }

    public function testGetAllWithPatternSecound() {
        $driver = new File('tests/data/storage.dat');
        $this->assertCount(3, $driver->search('key*es*'));
    }
}