<?php

namespace EpiCMS;

abstract class Box {

    const TEXT = '\EpiCMS\Box\Text';
    const UNDEFINED = '\EpiCMS\Box\Undefined';

    protected $namespace;
    protected $name;
    protected $key;
    protected $value;

    public static function prepare($key, $value = null) {
        $params = explode(':', $key);
        if (count($params) !== 3)
            throw new \InvalidArgumentException('invalid key: \''.$key.'\'');
        return self::$params[2]($params[0], $params[1], $value);
    }

    public static function __callStatic($type, array $args) {
        $type = '\\EpiCMS\\Box::'.strtoupper($type);
        self::validation($type, $args);
        $typeClass = constant($type);
        return new $typeClass($args[0], $args[1], isset($args[2]) ? $args[2] : null);
    }

    protected static function validation($typeClass, array $args) {
        if (!defined($typeClass))
            throw new \InvalidArgumentException('invalid box type: \''.$typeClass.'\'');
        if (count($args) < 2)
            throw new \InvalidArgumentException('invalid parameters count');
    }

    public function __construct($namespace, $name, $value = null) {
        $typeName = $this->prepareTypeName(get_class($this));
        $this->namespace = $namespace;
        $this->name = $name;
        $this->key = $this->prepareKey($typeName, $namespace, $name);
        $this->value = $value !== null ? $value : $this->load($this->key);
    }

    public function name() {
        return $this->name;
    }

    public function ns() {
        return $this->namespace;
    }

    public function key() {
        return $this->key;
    }

    public function value($value = null) {
        if ($value !== null)
            $this->value = $value;
        return $this->value;
    }

    public function __toString() {
        return (string) $this->value;
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