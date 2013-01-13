<?php

namespace EpiCMS\Box;

class Undefined extends \EpiCMS\Box {

	protected function load($key) {
		$output = parent::load($key);
		if ($output !== null)
			$this->type = $output->_type;
	}

}