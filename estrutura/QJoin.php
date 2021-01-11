<?php

class QJoin extends PadraoObjeto {
	var $table;
	var $primary;
	var $foreignKey;
	var $type = 'join';

	public function __construct($table, $primary, $foreignKey, $option = array()){
		$this->table = $table;
		$this->primary = $primary;
		$this->foreignKey = $foreignKey;
		$this->setOptions($option);
	}
}

?>