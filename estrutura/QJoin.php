<?php

class QJoin extends PadraoObjeto { 
	var $table; 				// Nome da tabela estrangeira
	var $primary; 				// Nome do campo da tabela primaria
	var $value = ''; 			// Comparar com um valor estatico
	var $foreignKey = ''; 		// Nome do campo da tabela estrangeira
	var $tbPrimary = ''; 		// Nome da tabela primaria
	var $type = 'join'; 		// Tipo de Objeto
	var $joinAdd = array(); 	// Condicições adicionais

	public function __construct($table, $primary, $value='', $option = array()) { 
		$this->table = $table;
		$this->primary = $primary;
		if ($value != '') $this->foreignKey = $value;
		$this->setOptions($option);
	}
}

?>