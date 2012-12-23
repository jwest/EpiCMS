<?php

namespace EpiCMS\Module;

use EpiCMS\Box;

class Api extends \Slim\Middleware {

    public function call() {
        $this->app->post('/admin/:namespace/:key', array($this, 'post'));
        $this->app->get('/admin/:namespace/:key', array($this, 'get'));
        $this->next->call();
    }

    public function post($namespace, $key) {
        $box = Box::undefined($namespace, $key);
        $box->value($this->app->request()->post('value'));
        $box->save();
        $this->app->response()->body(json_encode(array(
            'status' => 'ok',
            'value' => $box->value()
        )));
    }

    public function get($namespace, $key) {
        $box = Box::undefined($namespace, $key);
        $this->app->response()->body(json_encode(array(
            'key' => $box->key(),
            'value' => $box->value()
        )));
    }

}