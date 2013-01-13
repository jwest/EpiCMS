<?php

namespace EpiCMS;

use EpiCMS\Box;

class Boxes extends \ArrayIterator {

    public function __construct($pattern) {
        $boxes = $this->load($pattern);
        parent::__construct($boxes);
    }

    protected static function load($key) {
        return Box::driver()->search($key);
    }

    public function offsetGet($key) {
        $current = parent::offsetGet($key);
        $type = $current->_type;
        $value = $current->value;
        return Box::$type($key, $value);
    }

    public function current() {        
        $current = parent::current();
        $type = $current->_type;
        $value = $current->value;
        return Box::$type(self::key(), $value);
    }

}