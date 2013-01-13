<?php

use EpiCMS\Module\Front;
use EpiCMS\Box;

class EpiCMS_Module_FrontTest extends EpiCMS_Module_ModuleTesting {

    public function testGetRouteStatus() {
        $this->checkStatusCode('GET', '/', 200);
    }

    public function testGetRouteStatusOtherPage() {
        $this->checkStatusCode('GET', '/page:test-page', 200);
    }

    public function testGetRouteStatusNonExistsPage() {
        $this->checkStatusCode('GET', '/page:test-page-non-exist', 404);
    }

    public function testGetRouteStatusFromInvalidKey() {
        $this->checkStatusCode('GET', '/test-key-invalid', 404);
    }

    public function getObj() {
        return new Front();
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

        $app = $this->getMock('\Slim\Slim', array('render'), array(array(
            'log.writer' => new \Slim\LogWriter(fopen('php://stderr', 'w')),
        )));

        $app->expects($this->any())
            ->method('render')
            ->with(null, $this->arrayHasKey('page'));

        $app->setName(md5($method.$route));
        return $app;
    }

}