<?php


class QInput extends PadraoObjeto {
	var $input;
	var $type = 'input';
	var $table = '';

	function __construct($input, $option = array()){
		$this->input = $input;
		$this->setOptions($option);
	}
}



?>