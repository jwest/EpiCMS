<?php

use EpiCMS\Module\Auth;
use EpiCMS\Box;

class EpiCMS_Module_AuthTest extends EpiCMS_Module_ModuleTesting {

    public function setUp() {
        parent::setUp();
        \Strong\Strong::factory(array(
            'provider' => 'Hashtable',
            'users' => array(
                'admin' => 'test'
            )
        ));
    }

    public function testNotLogin() {
        $this->assertFalse(\Strong\Strong::getInstance()->loggedIn());
    }

    public function testGetRouteStatus() {
        $this->checkStatusCode('GET', '/admin', 200);
    }

    public function testPostRouteStatus() {
        $this->checkStatusCode('POST', '/admin', 302, 'username=admin&password=test');
        $this->assertTrue(\Strong\Strong::getInstance()->loggedIn());
    }

    public function testGetRouteRedirectUrlIfUserLogin() {
        $app = $this->checkStatusCode('GET', '/admin', 302, '');
        $this->assertEquals('/epicms/', $app->response()->header('location'));
    }

    public function testPostRouteRedirectUrl() {
        $app = $this->checkStatusCode('POST', '/admin', 302, 'username=admin&password=test');
        $this->assertEquals('/epicms/', $app->response()->header('location'));
    }

    public function testLogout() {
        $app = $this->checkStatusCode('GET', '/admin/logout', 302);
        $this->assertEquals('/epicms/', $app->response()->header('location'));
        $this->assertFalse(\Strong\Strong::getInstance()->loggedIn());
    }

    public function testPostRouteRedirectInvalidLogin() {
        $app = $this->checkStatusCode('POST', '/admin', 302, 'username=admin&password=testInvalid');
        $this->assertEquals('/epicms/admin', $app->response()->header('location'));
    }

    public function testGetOthenAdminPageUserLogout() {
        $app = $this->checkStatusCode('GET', '/admin/test', 401);
    }

    public function prepareMock($mockRedirect = false) {
        $mockMethods = array('render');

        if ($mockRedirect !== false)
            $mockMethods[] = 'redirect';

        $app = $this->getMock('\Slim\Slim', $mockMethods, array(array(
            'log.writer' => new \Slim\LogWriter(fopen('php://stderr', 'w')),
        )));

        if ($mockRedirect !== false)
            $app->expects($this->any())
                ->method('redirect')
                ->with($mockRedirect);

        $app->expects($this->any())
            ->method('render')
            ->with('auth.php');

        $app->get('/', function(){})->name('home');

        return $app;
    }

    public function getObj() {
        return new Auth();
    }

}