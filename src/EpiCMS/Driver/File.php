<?php

namespace EpiCMS\Driver;

class File extends \EpiCMS\Driver {

    protected $path;
    protected $data = array();

    public function __construct($path) {
        if (!is_file($path))
            throw new \InvalidArgumentException('invalid path: \''.$path.'\'');
        $this->path = $path;
        $this->data = $this->load($path);
    }

    public function get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function search($key) {
        $pattern = $this->preparePattern($key);
        $keys = array_filter(array_keys($this->data), function ($element) use ($pattern){
            return (bool)preg_match($pattern, $element);
        });
        return array_intersect_key($this->data, array_flip($keys));
    }

    public function set($key, $value) {
        $this->data[$key] = $value;
        $this->save($this->path, $this->data);
    }

    public function del($key) {
        unset($this->data[$key]);
        $this->save($this->path, $this->data);
    }

    public function dump() {
        return $this->data;
    }

    protected function load($path) {
        return unserialize(file_get_contents($path));
    }

    protected function save($path, $data) {
        file_put_contents($path, serialize($data));
    }

    protected function preparePattern($key) {
        return '/^'.str_replace('*', '(.)+', $key).'$/';
    }

}