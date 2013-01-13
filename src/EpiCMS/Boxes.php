<?php

namespace EpiCMS;

use EpiCMS\Box;

class Boxes extends \ArrayIterator {

    protected $namespace;

    public function __construct($namespace, $pattern = null) {
        $this->namespace = $namespace;
        $boxes = $this->load($this->prepareKey($namespace, $pattern));
        parent::__construct($boxes);
    }

    protected function prepareKey($namespace, $pattern) {
        return $namespace . ($pattern != null ? ':' . $pattern : ':') . '*';
    }

    protected static function load($key) {
        return Box::driver()->search($key);
    }

    public function current() {
        return Box::undefined(self::key(), parent::current());
    }

}