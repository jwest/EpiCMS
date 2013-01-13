<?php

use EpiCMS\Module\Api;
use EpiCMS\Box;

class EpiCMS_Module_ApiTest extends EpiCMS_Module_ModuleTesting {

    public function testGetRouteStatus() {
        $this->checkStatusCode('GET', '/admin/namespace:test-1', 200);
    }

    public function testPostRouteStatus() {
        $this->checkStatusCode('POST', '/admin/namespace:test-1', 200);
    }

    public function testGetRouteContent() {
        $this->checkOutput('GET', '/admin/namespace:test-1', '{"key":"namespace:test-1","value":"test","type":"undefined"}');
    }

    public function testPostRouteContent() {
        $this->checkOutput('POST', '/admin/namespace:test-1', '{"status":"ok","key":"namespace:test-1","value":"test","type":"undefined"}');
    }

    public function testGetRouteContentWithType() {
        $this->checkOutput('GET', '/admin/namespace:test-1/text', '{"key":"namespace:test-1","value":"test","type":"text"}');
    }

    public function testPostRouteContentWithType() {
        $this->checkOutput('POST', '/admin/namespace:test-1/text', '{"status":"ok","key":"namespace:test-1","value":"test","type":"text"}');
    }

    public function getObj() {
        return new Api();
    }

}