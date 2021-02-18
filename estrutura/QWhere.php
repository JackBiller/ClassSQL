<?php

class QWhere extends PadraoObjeto { 
	var $input; 				// Objeto do tipo QInput
	var $value; 				// Valor a ser comparado
	var $not_number = false; 	// Força as aspas se o for valor numerico
	var $password = false; 		// Se usa função PASSWORD do MySQL
	var $type = 'where'; 		// Tipo de Objeto

	function __construct($input, $value, $option = array()) { 
		$this->input = $input;
		$this->value = $value;
		$this->setOptions($option);
	}
}

?>