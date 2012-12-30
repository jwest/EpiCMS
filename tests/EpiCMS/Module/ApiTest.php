<?php

use EpiCMS\Module\Api;
use EpiCMS\Box;

class EpiCMS_Module_ApiTest extends EpiCMS_Module_ModuleTesting {

    public function testGetRouteStatus() {
        $this->checkStatusCode('GET', '/admin/namespace/test-1', 200);
    }

    public function testPostRouteStatus() {
        $this->checkStatusCode('POST', '/admin/namespace/test-1', 200);
    }

    public function testGetRouteContent() {
        $this->checkOutput('GET', '/admin/namespace/test-1', '{"key":"namespace:test-1","value":"test1"}');
    }

    public function testPostRouteContent() {
        $this->checkOutput('POST', '/admin/namespace/test-1', '{"status":"ok","value":"test1"}');
    }

    public function getObj() {
        return new Api();
    }

}