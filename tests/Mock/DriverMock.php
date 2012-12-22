<?php
/**
 * mock storage for phpunit
 */
class DriverMock extends \EpiCMS\Driver {

    protected $data = array(
        'text:namespace:test-1' => 'test',
    );

    public function get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function set($key, $value) {
        $this->data[$key] = $value;
    }

    public function del($key) {
        unset($this->data[$key]);
    }

}