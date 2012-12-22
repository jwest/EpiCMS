<?php

namespace EpiCMS;

use EpiCMS\Box;

class Boxes extends \ArrayIterator {

    protected $namespace;

    public function __construct($namespace) {
        $this->namespace = $namespace;
        $boxes = $this->load($namespace);
        parent::__construct($boxes);
    }

    protected function load($namespace) {
        return Box::driver()->getAll($namespace.':*');
    }

    public function current() {
        return Box::prepare(self::key(), parent::current());
    }

}