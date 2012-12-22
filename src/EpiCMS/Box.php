<?php

namespace EpiCMS;

abstract class Box {

    const TEXT = '\EpiCMS\Box\Text';

    protected $key;
    protected $value;

    protected static $driver = null;

    public static function driver(Driver $driver = null) {
        if ($driver === null)
            return self::$driver;
        self::$driver = $driver;
    }

    public static function load($type, $namespace, $name) {
        return new $type($type::NAME, $namespace, $name);
    }

    public function __construct($typeName, $namespace, $name) {
        $this->key = $this->prepareKey($typeName, $namespace, $name);
        $this->value = $this->prepareValue($this->key);
    }

    public function key() {
        return $this->key;
    }

    public function value($value = null) {
        if ($value !== null)
            $this->value = $value;
        return $this->value;
    }

    protected function prepareKey($typeName, $namespace, $name) {
        return $typeName.':'.$namespace.':'.$name;
    }

    protected function prepareValue($key) {
        return self::driver()->get($key);
    }

    public function save() {
        self::driver()->set($this->key, $this->value);
    }

    public function remove() {
        self::driver()->del($this->key);
    }
}