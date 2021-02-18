<?php

class QInsert extends PadraoObjeto { 
	var $value = array(); 		// Recebe um array de objetos do tipo Value
	var $table; 				// Nome da tabela do BD
	var $type = 'insert'; 		// Tipo de Objeto

	function __construct($table, $option = array()) { 
		$this->table = $table;
		$this->setOptions($option);
	}
}

?>