<?php

class QValue extends PadraoObjeto { 
	var $input;					// Nome do campo da tabela do BD
	var $value;					// Nome do campo da tabela do BD
	var $not_number = false;	// Forçar valor ser texto ndependente se ele for numerico
	var $type = 'value';		// Tipo de Objeto


	// Variaveis Internas
	var $typeOp = '1'; 			// Vai definir como vai retorna o valor setado

	function __construct($input, $value, $option = array()) { 
		$this->input = $input;
		$this->value = $value;
		$this->setOptions($option);
	}

	public function getVal() { 
		$val = '';

		switch ($this->typeOp) { 
			case '1':
				$val = $this->input;
				break;
			case '2':
				$val = $this->getValue();
				break;
			case '3':
				$val = $this->input . ' = ' . $this->getValue();
				break;
		}
		return $val;
	}

	private function getValue() { 
		$value = $this->value;
		return is_numeric($value) && !$this->not_number ? $value : "'$value'";
	}
}

?>