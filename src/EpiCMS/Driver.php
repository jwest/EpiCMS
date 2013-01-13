<?php

namespace EpiCMS;

abstract class Driver {

    abstract public function get($key);

    abstract public function search($key);

    abstract public function set($key, array $value = null);

    abstract public function del($key);

    abstract public function dump();

}