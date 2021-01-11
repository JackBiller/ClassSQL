<?php

class QSelect extends PadraoObjeto {
	var $select = array();
	var $where = array();
	var $join = array();
	var $orderBy = '';
	var $table;
	var $type = 'select';

	function __construct($table, $option = array()){
		$this->table = $table;
		$this->setOptions($option);
	}
}

?>