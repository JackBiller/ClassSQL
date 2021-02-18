<?php

class QInput extends PadraoObjeto { 
	var $input;				// Nome do campo da tabela do BD
	var $table = '';		// Nome da tabela do BD
	var $type = 'input';	// Tipo de Objeto

	function __construct($input, $option = array()) { 
		$this->input = $input;
		$this->setOptions($option);
	}
}

?>