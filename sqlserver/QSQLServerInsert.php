<?php

class QSQLServerInsert extends PadraoObjeto { 
	var $insert;

	function __construct($insert, $option = array()) { 
		$this->insert = $insert;
		$this->setOptions($option);
	}

	public function returnSQL($tab = '') { 
		$insert = $this->insert;
		if ($insert->get('type') != 'insert') return false;

		$sql = $tab . "INSERT INTO ";

		$table = $insert->get('table');

		$sql .= $table . " (\n\t";

		$sql .= $this->toParams($insert->get('value'), $table, 
			array('typeOp' => "1", 'fisrt' => '?, ')
		);

		$sql .= "\n) VALUE (\n\t";

		$sql .= $this->toParams($insert->get('value'), $table, 
			array('typeOp' => "2", 'fisrt' => '?, ')
		);

		$sql .= "\n);";

		return $sql;
	}

	private function toParams($params, $table, $option = array()) { 
		$sql = '';

		$keys = array();
		foreach ($option as $key => $value) array_push($keys, $key);

		$fisrt 		= in_array('fisrt', 	$keys) ? explode('?',$option['fisrt']) : array('','');
		$default 	= in_array('default', 	$keys) ? $option['default'] : '';
		$preF 		= in_array('preF', 		$keys) ? $option['preF'] : '';
		$typeOp 	= in_array('typeOp', 	$keys) ? $option['typeOp'] : '';

		$cont = 0;
		if (sizeof($params) == 0) $sql = $default;
		else {
			foreach ($params as $key => $value) { 
				if ($typeOp != '') $value->typeOp = $typeOp;

				$sql .= $preF . ($cont == 0 ? $fisrt[0] : $fisrt[1]) . $this->resolveParam($table, $value, $key);
				$cont++;
			}
		}

		return $sql;
	}

	private function resolveParam($defaultTable, $val, $as = '') { 
		$sql = '';
		switch ($val->get('type')) { 
			case 'value': $sql = $this->returnValueParam($defaultTable, $val, $as); break;
		}
		return $sql;
	}

	private function returnValueParam($defaultTable, $val, $as = '') { 
		$sql = "";

		$sql = $val->getVal();

		return $sql;
	}
}

?>