<?php

namespace EpiCMS\Module;

use EpiCMS\Box;

class Front extends \Slim\Middleware {

    public function call() {
        $this->app->get('/(:page)', array($this, 'get'));
        $this->next->call();
    }

    public function get($page = 'index') {
        $page = Box::text('page', $page);
        if ($page->value() === null)
            $this->app->notFound();
        var_export(array('page' => $page));
        $this->app->render($this->app->config('layout.default'), array('page' => $page));
    }

}