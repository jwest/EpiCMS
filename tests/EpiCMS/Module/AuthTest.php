<?php

use EpiCMS\Module\Auth;
use EpiCMS\Box;

class EpiCMS_Module_AuthTest extends EpiCMS_Module_ModuleTesting {

    public function testGetRouteStatus() {
        $this->checkStatusCode('GET', '/admin', 200);
    }

    public function testPostRouteStatus() {
        $this->checkStatusCode('POST', '/admin', 200);
    }

    public function testGetRouteContent() {
        $this->checkOutput('GET', '/admin', 'test');
    }

    public function testPostRouteContent() {
        $this->checkOutput('POST', '/admin', 'test');
    }

    public function getObj() {
        return new Auth();
    }

}