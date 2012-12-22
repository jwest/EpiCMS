<?php

namespace EpiCMS;

abstract class Driver {

    abstract public function get($key);

    abstract public function set($key, $value);

    abstract public function del($key);

}