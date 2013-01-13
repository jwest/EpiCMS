<?php

namespace EpiCMS;

class Box {

    const TEXT = '\EpiCMS\Box\Text';
    const UNDEFINED = '\EpiCMS\Box\Undefined';

    protected $key;
    protected $value;

    public static function __callStatic($type, array $args) {
        self::validation($type, $args);
        $typeClass = constant(self::prepareClassName($type));
        return new $typeClass($args[0], isset($args[1]) ? $args[1] : null);
    }

    protected static function validation($type, array $args) {
        $typeClass = self::prepareClassName($type);
        if (!defined($typeClass))
            throw new \InvalidArgumentException('invalid box type: \''.$typeClass.'\'');
        if (count($args) < 1)
            throw new \InvalidArgumentException('invalid parameters count');
    }

    protected static function prepareClassName($type) {
        return '\\EpiCMS\\Box::'.strtoupper($type);
    }

    protected function __construct($key, $value = null) {
        $this->type = $this->getTypeName(get_class($this));
        $this->key = $key;
        if ($value !== null)
            $this->value = $value;    
        else
            $this->load($this->key);
    }

    protected function getTypeName($typeClass) {
        $typeNameParts = explode('\\', $typeClass);
        return strtolower($typeNameParts[count($typeNameParts)-1]);
    }

    public function type($newType = null) {        
        if ($newType !== null) {
            return Box::$newType($this->key, $this->value);
        }
        return $this->type;
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
        return (string) $this->value();
    }

    protected function load($key) {
        $output = self::driver()->get($key);
        $this->value = $output['value'];
        if ($output['_type'] !== 'undefined')
            $this->type = $output['_type'];
    }

    public function save() {
        $value = array('_type' => $this->type, 'value' => $this->value);
        self::driver()->set($this->key, $value);
    }

    public function remove() {
        self::driver()->del($this->key);
    }

    public function hash() {
        return md5($this->key.$this->value);
    }

    protected static $driver = null;

    public static function driver(Driver $driver = null) {
        if ($driver !== null)
            self::$driver = $driver;
        return self::$driver;
    }
}