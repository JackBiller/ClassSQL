<?php


class QWhere extends PadraoObjeto {
	var $input;
	var $value;
	var $not_number = false;
	var $password = false;
	var $type = 'where';

	function __construct($input, $value, $option = array()) {
		$this->input = $input;
		$this->value = $value;
		$this->setOptions($option);
	}
}


?>