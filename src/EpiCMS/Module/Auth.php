<?php

namespace EpiCMS\Module;

use EpiCMS\Box;
use Strong\Strong;

class Auth extends \Slim\Middleware {

    public function call() {
        $this->app->post('/admin', array($this, 'post'));
        $this->app->get('/admin', array($this, 'get'))->name('auth');
        $this->app->get('/admin/logout', array($this, 'logout'))->name('logout');
        if (!$this->checkLogin())
            $this->fail();
        else
            $this->next->call();
    }

    public function checkLogin() {
        if (strpos($this->app->request()->getPathInfo(), '/admin/') === 0) {
            if (!Strong::getInstance()->loggedIn())
                return false;
        }
        return true;
    }

    protected function fail() {
        $this->app->response()->status(401);
    }

    public function post() {
        $username = $this->app->request()->params('username');
        $password = $this->app->request()->params('password');
        Strong::getInstance()->login($username, $password);

        if (Strong::getInstance()->loggedIn())
            $this->app->redirect($this->app->urlFor('home'));
        else
            $this->app->redirect($this->app->urlFor('auth'));
    }

    public function get() {
        if (Strong::getInstance()->loggedIn())
            $this->app->redirect($this->app->urlFor('home'));
        $this->app->render('auth.php');
    }

    public function logout() {
        Strong::getInstance()->logout();
        $this->app->redirect($this->app->urlFor('home'));
    }

}