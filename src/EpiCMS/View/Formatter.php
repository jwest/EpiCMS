<?php

namespace EpiCMS\View;

use EpiCMS\Box;
use Slim\Slim;

abstract class Formatter {

	protected $app;

	public function __construct(Slim $app = null) {
		$this->app = $app;
	}

	abstract public function box(Box $box);

	abstract public function __toString();

}