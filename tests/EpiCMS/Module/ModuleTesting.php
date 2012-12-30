<?php

//use EpiCMS\Module\Api;
use EpiCMS\Box;

abstract class EpiCMS_Module_ModuleTesting extends PHPUnit_Framework_TestCase {

    abstract public function getObj();

    public function checkStatusCode($method, $route, $status) {
        $app = $this->slimMock($method, $route);
        $app->add($this->getObj());
        $app->run();
        $this->assertEquals($status, $app->response()->status());
    }

    public function checkOutput($method, $route, $output) {
        $app = $this->slimMock($method, $route);
        $app->add($this->getObj());
        $app->run();
        $this->assertEquals($output, $app->response()->body());
    }

    public function setUp() {
        Box::driver(new DriverMock);
        ob_start();
    }

    public function tearDown() {
        ob_clean();
    }

    public function prepareMock() {
        $app = $this->getMock('\Slim\Slim', array('render'), array(array(
            'log.writer' => new \Slim\LogWriter(fopen('php://stderr', 'w')),
        )));

        $app->expects($this->any())
            ->method('render')
            ->with(null, $this->arrayHasKey('page'));

        return $app;
    }

    private function slimMock($method, $route) {
        \Slim\Environment::mock(array(
            'REQUEST_METHOD' => $method,
            'REMOTE_ADDR' => '127.0.0.1',
            'SCRIPT_NAME' => '/epicms',
            'PATH_INFO' => $route,
            'QUERY_STRING' => '',
            'SERVER_NAME' => 'localhost',
            'SERVER_PORT' => '80',
            'HOST' => 'localhost',
            'CONNECTION' => 'keep-alive',
            'CACHE_CONTROL' => 'max-age=0',
            'USER_AGENT' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.4 (KHTML, like Gecko) Ubuntu/12.10 Chromium/22.0.1229.94 Chrome/22.0.1229.94 Safari/537.4',
            'ACCEPT' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'ACCEPT_ENCODING' => 'gzip,deflate,sdch',
            'ACCEPT_LANGUAGE' => 'pl,af;q=0.8,en;q=0.6',
            'ACCEPT_CHARSET' => 'ISO-8859-2,utf-8;q=0.7,*;q=0.3',
            'slim.url_scheme' => 'http',
            'slim.input' => '',
            'slim.errors' => NULL,
        ));

        $app = $this->prepareMock();

        $app->setName(md5($method.$route));
        return $app;
    }

}