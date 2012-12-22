<?php

namespace EpiCMS;

abstract class Box {

    const TEXT = '\EpiCMS\Box\Text';

    protected $key;
    protected $value;

    protected static $driver = null;

    public static function driver(Driver $driver = null) {
        if ($driver !== null)
            self::$driver = $driver;
        return self::$driver;
    }

    public static function __callStatic($type, array $args) {
        $typeClass = '\\EpiCMS\\Box::'.strtoupper($type);
        self::validation($typeClass, $args);
        $type = constant($typeClass);
        return new $type($type::NAME, $args[0], $args[1]);
    }

    protected static function validation($typeClass, array $args) {
        if (!defined($typeClass))
            throw new \InvalidArgumentException('invalid box type: \''.$typeClass.'\'');
        if (count($args) < 2)
            throw new \InvalidArgumentException('invalid parameters count');
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

    public function save() {
        self::driver()->set($this->key, $this->value);
    }

    public function remove() {
        self::driver()->del($this->key);
    }

    protected function prepareKey($typeName, $namespace, $name) {
        return $typeName.':'.$namespace.':'.$name;
    }

    protected function prepareValue($key) {
        return self::driver()->get($key);
    }
}