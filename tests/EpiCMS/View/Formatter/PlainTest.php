<?php

use EpiCMS\Box;
use EpiCMS\View\Formatter\Plain;

class EpiCMS_View_Formatter_PlainTest extends PHPUnit_Framework_TestCase {

    public function testCreateInstance() {
        $formatter = new Plain();
        $this->assertInstanceOf('\EpiCMS\View\Formatter', $formatter);
    }

    public function testShowBox() {
    	$formatter = new Plain();
        $this->assertEquals('value', $formatter->box(Box::text('key', 'value')));
    }

    public function testToString() {
    	$formatter = new Plain();
        $this->assertEquals('', $formatter->__toString());	
    }

}