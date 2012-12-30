<?php

use EpiCMS\Module\EditAll;
use EpiCMS\Box;

class EpiCMS_Module_EditAllTest extends EpiCMS_Module_ModuleTesting {

    public function testGetRouteStatus() {
        $this->checkStatusCode('GET', '/admin/editAll', 200);
    }

    public function testGetRouteOutput() {
        $this->checkOutput('GET', '/admin/editAll', '{"boxes":{"namespace:test-1":"test1","namespace2:test-1":"test3","namespace2:test-2":"test4","namespace2:test-3":"test5","page:main":"main-page","page:test-page":"test-page"}}');
    }

    public function getObj() {
        return new EditAll();
    }

}