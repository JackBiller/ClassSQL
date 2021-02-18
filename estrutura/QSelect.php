<?php

class QSelect extends PadraoObjeto { 
	var $select = array(); 		// Recebe um array de objetos do tipo Select
	var $where = array(); 		// Recebe um array de objetos do tipo Where
	var $join = array(); 		// Recebe um array de objetos do tipo Join
	var $limit = array(); 		// Recebe um array de objetos do tipo Limit
	var $orderBy = ''; 			// Como irar orderar
	var $table; 				// Nome da tabela do BD
	var $type = 'select'; 		// Tipo de Objeto

	function __construct($table, $option = array()) { 
		$this->table = $table;
		$this->setOptions($option);
	}
}

?>