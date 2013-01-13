<?php

use EpiCMS\Box;
use EpiCMS\View\Formatter\Editable;

class EpiCMS_View_Formatter_EditableTest extends PHPUnit_Framework_TestCase {

    public function testCreateInstance() {
        $formatter = new Editable();
        $this->assertInstanceOf('\EpiCMS\View\Formatter', $formatter);
    }

    public function testShowBox() {
    	$formatter = new Editable();
        $this->assertEquals('<span class="editable" data-type="text" data-pk="6a02f950958aeda3dbbf83fbb306a030">value</span>', $formatter->box(Box::text('key', 'value')));
    }

    public function testToString() {
    	$formatter = new Editable($this->slimMock('get', 'test'));
    	$this->assertEquals('<script></script>', $formatter->__toString());
    }

    private function slimMock($method, $route) {
        $app = $this->getMock('\Slim\Slim', array('render'), array(array(
            'log.writer' => new \Slim\LogWriter(fopen('php://stderr', 'w')),
        )));

        $app->expects($this->any())
            ->method('render')
            ->with('formatter/editableScript.php')
            ->will($this->returnValue('<script></script>'));

        $app->setName(md5($method.$route));
        return $app;
    }

}