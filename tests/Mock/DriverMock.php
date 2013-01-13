<?php
/**
 * mock storage for phpunit
 */
class DriverMock extends \EpiCMS\Driver {

    protected $data = array();

    public function __construct() {
        $this->data = array(
            'namespace:test-1'   => (object) array('_type' => 'undefined', 'value' => 'test'),
            'namespace2:test-1'  => (object) array('_type' => 'undefined', 'value' => 'test3'),
            'namespace2:test-2'  => (object) array('_type' => 'undefined', 'value' => 'test4'),
            'namespace2:test-3'  => (object) array('_type' => 'undefined', 'value' => 'test5'),
            'page:main'          => (object) array('_type' => 'text', 'value' => 'main-page'),
            'page:test-page'     => (object) array('_type' => 'text', 'value' => 'test-page'),
        );
    }

    public function get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function search($key) {
        $pattern = $this->preparePatter($key);
        $keys = array_filter(array_keys($this->data), function ($element) use ($pattern){
            return (bool)preg_match($pattern, $element);
        });
        return array_intersect_key($this->data, array_flip($keys));
    }

    protected function preparePatter($key) {
        return '/'.str_replace('*', '(.)+', $key).'/';
    }

    public function set($key, array $value = null) {
        $this->data[$key] = $value;
    }

    public function del($key) {
        unset($this->data[$key]);
    }

    public function dump() {
        return $this->data;
    }

}