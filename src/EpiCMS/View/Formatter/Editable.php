<?php

namespace EpiCMS\View\Formatter;

use EpiCMS\Box;
use EpiCMS\View\Formatter;

class Editable extends Formatter {

	public function box(Box $box) {
		return '<span class="editable" data-type="'.$box->type().'" data-pk="'.$box->hash().'">'.$box->value().'</span>';
	}

	public function __toString() {
		return $this->app->render('formatter/editableScript.php');
	}

}
