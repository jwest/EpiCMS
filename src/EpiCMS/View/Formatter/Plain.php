<?php

namespace EpiCMS\View\Formatter;

use EpiCMS\Box;
use EpiCMS\View\Formatter;

class Plain extends Formatter {

	public function box(Box $box) {
		return $box->value();
	}

	public function __toString() {
		return '';
	}

}