<?php

class QFirebirdUpdate extends PadraoObjeto { 
	var $update;

	function __construct($update, $option = array()) { 
		$this->update = $update;
		$this->setOptions($option);
	}

	public function returnSQL($tab = '') { 
		$update = $this->update;
		if ($update->get('type') != 'update') return false;

		$sql = $tab . "UPDATE ";

		$table = $update->get('table');

		$sql .= $table . "\nSET ";

		$sql .= $this->toParams($update->get('value'), $table, 
			array('typeOp' => "3", 'fisrt' => "?\n, \t")
		);

		$sql .= $this->toParams($update->get('where'), $table, array('fisrt' => 'WHERE ?AND ', 'preF' => $tab."\n"));

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
		switch ($val->type) { 
			case 'value': $sql = $this->returnValueParam($defaultTable, $val, $as); break;
			case 'input': $sql = $this->returnInputParam($defaultTable, $val, $as); break;
			case 'where': $sql = $this->returnWhereParam($defaultTable, $val, $as); break;
		}
		return $sql;
	}

	private function returnValueParam($defaultTable, $val, $as = '') { 
		$sql = "";

		$sql = $val->getVal();

		return $sql;
	}

	private function returnInputParam($defaultTable, $val, $as = '') { 
		$sql = "";
		$table = $val->get('table') != '' ? $val->get('table') : $defaultTable;
		$sql .= $table . '.' . $val->get('input') . (is_numeric($as) || empty($as) ? '' : ' AS ' . $as);
		return $sql;
	}

	private function returnWhereParam($defaultTable, $val, $as = '') { 
		$sql = "";

		$input = $val->get('input');
		if (in_array(gettype($input), array('string','integer','boolean','double'))) { 
			$sql .= $input;
		} else { 
			$sql .= $this->resolveParam($defaultTable, $input, $as);
		}

		$sql .= " = ";

		$value = $val->get('value');
		if (in_array(gettype($value), array('string','integer','boolean','double'))) { 
			$value = is_numeric($value) && !$val->get('not_number') ? $value : "'$value'";
		} else { 
			$value = $this->resolveParam($defaultTable, $value, $as);
		}
		if ($val->get('password')) $value = "PASSWORD($value)";

		$sql .= $value;

		return $sql;
	}
}

?>