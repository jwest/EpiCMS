<?php

namespace EpiCMS\Box;

class Undefined extends \EpiCMS\Box {

    public function type($typeName) {
        $typeName = '\\EpiCMS\\Box\\'.$typeName;
        return $typeName::prepare($this->key, $this->value);
    }

}