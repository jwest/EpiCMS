<?php

namespace EpiCMS;

abstract class Box {

    const TEXT = '\EpiCMS\Box\Text';

    protected $key;
    protected $value;

    public static function prepare($key, $value = null) {
        list($namespace, $key, $type) = explode(':', $key);
        $box = self::$type($namespace, $key);
        $box->value($value);
        return $box;
    }

    public static function __callStatic($type, array $args) {
        $type = '\\EpiCMS\\Box::'.strtoupper($type);
        self::validation($type, $args);
        $typeClass = constant($type);
        return new $typeClass($args[0], $args[1]);
    }

    protected static function validation($typeClass, array $args) {
        if (!defined($typeClass))
            throw new \InvalidArgumentException('invalid box type: \''.$typeClass.'\'');
        if (count($args) < 2)
            throw new \InvalidArgumentException('invalid parameters count');
    }

    public function __construct($namespace, $name) {
        $typeName = $this->prepareTypeName(get_class($this));
        $this->key = $this->prepareKey($typeName, $namespace, $name);
        $this->value = $this->load($this->key);
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

    private function prepareTypeName($typeClass) {
        $typeNameParts = explode('\\', $typeClass);
        $typeName = $typeNameParts[count($typeNameParts)-1];
        return strtolower($typeName);
    }

    protected function prepareKey($typeName, $namespace, $name) {
        return $namespace.':'.$name.':'.$typeName;
    }

    protected function load($key) {
        return self::driver()->get($key);
    }

    protected static $driver = null;

    public static function driver(Driver $driver = null) {
        if ($driver !== null)
            self::$driver = $driver;
        return self::$driver;
    }
}