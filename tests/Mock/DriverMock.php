<?php
/**
 * mock storage for phpunit
 */
class DriverMock extends \EpiCMS\Driver {

    protected $data = array(
        'namespace:test-1:text'   => 'test1',
        'namespace2:test-1:text'  => 'test3',
        'namespace2:test-2:image' => 'test4',
        'namespace2:test-3:bool'  => 'test5',
    );

    public function get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function getAll($key) {
        $pattern = $this->preparePatter($key);
        $keys = array_filter(array_keys($this->data), function ($element) use ($pattern){
            return (bool)preg_match($pattern, $element);
        });
        return array_intersect_key($this->data, array_flip($keys));
    }

    protected function preparePatter($key) {
        return '/'.str_replace('*', '(.)+', $key).'/';
    }

    public function set($key, $value) {
        $this->data[$key] = $value;
    }

    public function del($key) {
        unset($this->data[$key]);
    }

}