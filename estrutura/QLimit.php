<?php

class QLimit extends PadraoObjeto { 
	var $val = 0; 			// Valor do limit
	var $type = 'limit'; 	// Tipo de Objeto

	function __construct($val, $option = array()) { 
		$this->val = $val;
		$this->setOptions($option);
	}
}

?>