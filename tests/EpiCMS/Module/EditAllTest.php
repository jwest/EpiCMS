<?php

use EpiCMS\Module\EditAll;
use EpiCMS\Box;

class EpiCMS_Module_EditAllTest extends EpiCMS_Module_ModuleTesting {

    public function testGetRouteStatus() {
        $this->checkStatusCode('GET', '/admin/editAll', 200);
    }

    public function testGetRouteStatusJSONData() {
        $this->checkStatusCode('GET', '/admin/editAll', 200, '', array('X_REQUESTED_WITH' => 'XMLHttpRequest'));
    }

    public function testGetRouteOutput() {
        $app = $this->checkStatusCode('GET', '/admin/editAll', 200);
    }

    public function testGetRouteOutputJSONData() {
        $this->checkOutput('GET', '/admin/editAll', '{"boxes":{"namespace:test-1":{"_type":"undefined","value":"test"},"namespace2:test-1":{"_type":"undefined","value":"test3"},"namespace2:test-2":{"_type":"undefined","value":"test4"},"namespace2:test-3":{"_type":"undefined","value":"test5"},"page:main":{"_type":"text","value":"main-page"},"page:test-page":{"_type":"text","value":"test-page"}}}', '', array('X_REQUESTED_WITH' => 'XMLHttpRequest'));
    }

    public function getObj() {
        return new EditAll();
    }

    public function renderTemplateName() {
        return 'editAll.php';
    }

    public function renderParams() {
        return $this->arrayHasKey('boxes');
    }
}