<?php

namespace EpiCMS\Module;

use EpiCMS\Box;

class Auth extends \Slim\Middleware {

    public function call() {
        $this->app->post('/admin', array($this, 'post'));
        $this->app->get('/admin', array($this, 'get'));
        $this->next->call();
    }

    public function post() {
        $this->app->response()->body('test');
    }

    public function get() {
        $this->app->response()->body('test');
    }

}