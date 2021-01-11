<?php

class QMySQLSelect extends PadraoObjeto {
	var $select;

	function __construct($select, $option = array()) {
		$this->select = $select;
		$this->setOptions($option);
	}

	public function returnSQL($tab = ''){
		$select = $this->select;
		if ($select->get('type') != 'select') return false;

		$sql = $tab . "SELECT ";

		$table = $select->get('table');

		$sql .= $this->toParams($select->get('select'), $table, 
			array('default' => "*", 'fisrt' => '?, ', 'preF' => $tab."\n\t")
		);

		$sql .= $tab . "\nFROM $table";

		$sql .= $this->toParams($select->get('join'), $table, array('preF' => $tab."\nINNER JOIN "));

		$sql .= $this->toParams($select->get('where'), $table, array('fisrt' => 'WHERE ?AND ', 'preF' => $tab."\n"));

		$sql .= ";";
		return $sql;
	}

	private function toParams($params, $table, $option = array()){
		$sql = '';

		$keys = array();
		foreach ($option as $key => $value) array_push($keys, $key);

		$fisrt 		= in_array('fisrt', 	$keys) ? explode('?',$option['fisrt']) : array('','');
		$default 	= in_array('default', 	$keys) ? $option['default'] : '';
		$preF 		= in_array('preF', 		$keys) ? $option['preF'] : '';

		$cont = 0;
		if (sizeof($params) == 0) $sql = $default;
		else {
			foreach ($params as $key => $value) {
				$sql .= $preF . ($cont == 0 ? $fisrt[0] : $fisrt[1]) . $this->resolveParam($table, $value, $key);
				$cont++;
			}
		}

		return $sql;
	}

	private function resolveParam($defaultTable, $val, $as = ''){
		$sql = '';
		switch ($val->get('type')) {
			case 'input': $sql = $this->returnInputParam($defaultTable, $val, $as); break;
			case 'where': $sql = $this->returnWhereParam($defaultTable, $val, $as); break;
			case 'join': $sql = $this->returnJoinParam($defaultTable, $val, $as); break;
		}
		return $sql;
	}

	private function returnInputParam($defaultTable, $val, $as = ''){
		$sql = "";
		$table = $val->get('table') != '' ? $val->get('table') : $defaultTable;
		$sql .= $table . '.' . $val->get('input') . (is_numeric($as) || empty($as) ? '' : ' AS ' . $as);
		return $sql;
	}

	private function returnWhereParam($defaultTable, $val, $as = ''){
		$sql = "";

		$input = $val->get('input');
		if (gettype($input) == 'string'){
			$sql .= $input;
		} else {
			$sql .= $this->resolveParam($defaultTable, $input, $as);
		}

		$sql .= " = ";

		$value = $val->get('value');
		if (gettype($value) == 'string'){
			$value = is_numeric($value) && !$val->get('not_number') ? $value : "'$value'";
		} else {
			$value = $this->resolveParam($defaultTable, $value, $as);
		}
		if($val->get('password')) $value = "PASSWORD($value)";

		$sql .= $value;

		return $sql;
	}


	private function returnJoinParam($defaultTable, $val, $as = ''){
		$sql = "";

		$sql = $val->get('table') . 
				" ON " . 
					$val->get('table') . "." . $val->get('primary') . 
				" = " . 
					$defaultTable . '.' . $val->get('foreignKey');

		return $sql;
	}
}


?>