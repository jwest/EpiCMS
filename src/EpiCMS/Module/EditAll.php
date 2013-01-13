<?php

namespace EpiCMS\Module;

use EpiCMS\Box;
use EpiCMS\Boxes;

class EditAll extends \Slim\Middleware {

    public function call() {
        $this->app->get('/admin/editAll', array($this, 'get'));
        $this->next->call();
    }

    public function get() {
        $boxes = new Boxes('*');        
        if ($this->app->request()->isAjax()) {
            $this->app->response()->body(json_encode(array(
                'boxes' => $boxes,
            )));
        } else {
            $this->app->render('editAll.php', array('boxes' => $boxes));
        }
    }

}