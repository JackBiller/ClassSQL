<?php

class QUpdate extends PadraoObjeto { 
	var $value = array(); 		// Recebe um array de objetos do tipo Value
	var $where = array(); 		// Recebe um array de objetos do tipo Where
	var $table; 				// Nome da tabela do BD
	var $type = 'update'; 		// Tipo de Objeto

	function __construct($table, $option = array()) { 
		$this->table = $table;
		$this->setOptions($option);
	}
}

?>