<?php

namespace EpiCMS\Module;

use EpiCMS\Box;

class Front extends \Slim\Middleware {

    public function call() {
        $this->app->get('/(:page)', array($this, 'get'))->name('home');
        $this->next->call();
    }

    public function get($page = 'main') {
        $page = Box::text('page:'.$page);
        if ($page->value() === null)
            $this->app->notFound();
        $this->app->render($this->app->config('layout.default'), array('page' => $page));
    }

}