<?php

class QJoinAdd extends PadraoObjeto { 
	var $table; 				// Nome da tabela estrangeira
	var $primary; 				// Nome do campo da tabela primaria
	var $value = ''; 			// Comparar com um valor estatico
	var $foreignKey = ''; 		// Nome do campo da tabela estrangeira
	var $tbPrimary = ''; 		// Nome da tabela primaria
	var $type = 'joinAdd'; 		// Tipo de Objeto

	public function __construct($table, $primary, $option = array()) { 
		$this->table = $table;
		$this->primary = $primary;
		$this->setOptions($option);
	}
}

?>