<?php

namespace EpiCMS\Module;

use EpiCMS\Box;

class Api extends \Slim\Middleware {

    public function call() {
        $this->app->post('/admin/:key(/:type)', array($this, 'post'));
        $this->app->get('/admin/:key(/:type)', array($this, 'get'));
        $this->next->call();
    }

    public function post($key, $type = 'undefined') {
        $box = Box::$type($key);
        $box->value($this->app->request()->post('value'));
        $box->save();
        $this->app->response()->body(json_encode(array(
            'status' => 'ok',
            'key' => $box->key(),
            'value' => $box->value(),
            'type' => $box->type(),
        )));
    }

    public function get($key, $type = 'undefined') {
        $box = Box::$type($key);
        $this->app->response()->body(json_encode(array(
            'key' => $box->key(),
            'value' => $box->value(),
            'type' => $box->type(),
        )));
    }

}