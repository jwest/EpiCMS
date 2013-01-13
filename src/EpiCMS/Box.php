<?php

namespace EpiCMS;

use \EpiCMS\View\Formatter;

class Box {

    const TEXT = '\EpiCMS\Box\Text';
    const TEXTAREA = '\EpiCMS\Box\Textarea';
    const UNDEFINED = '\EpiCMS\Box\Undefined';

    protected $key;
    protected $value;

    public static function __callStatic($type, array $args) {
        $type = '\\EpiCMS\\Box\\'.ucfirst($type);
        self::validation($type, $args);
        return new $type($args[0], isset($args[1]) ? $args[1] : null);
    }

    protected static function validation($type, array $args) {        
        if (!class_exists($type))
            throw new \InvalidArgumentException('invalid box type: \''.$type.'\'');
        if (count($args) < 1)
            throw new \InvalidArgumentException('invalid parameters count');
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
        return (string) self::$formatter->box($this);
    }

    protected function load($key) {
        $output = self::driver()->get($key);
        if ($output === null)
            return;
        $this->value = $output->value;        
        return $output;
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
    protected static $formatter = null;

    public static function driver(Driver $driver = null) {
        if ($driver !== null)
            self::$driver = $driver;
        return self::$driver;
    }

    public static function formatter(Formatter $formatter = null) {
        if ($formatter !== null)
            self::$formatter = $formatter;
        return self::$formatter;
    }
}