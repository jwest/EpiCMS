<?php

namespace EpiCMS\Module;

use EpiCMS\Box;

class EditAll extends \Slim\Middleware {

    public function call() {
        $this->app->get('/admin/editAll', array($this, 'get'));
        $this->next->call();
    }

    public function get() {
        $this->app->response()->body(json_encode(array(
            'boxes' => $this->dumpAll()
        )));
    }

    public function dumpAll() {
        $boxes = array();
        foreach (Box::driver()->dump() as $key => $value)
            $boxes[] = Box::prepare($key, $value);
        return $boxes;
    }

}