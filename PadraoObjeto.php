<?php

class PadraoObjeto {
	public function get($nome_campo){
		return $this->$nome_campo;
	}

	public function set($valor , $nome_campo){
		$this->$nome_campo = $valor;
	}

	public function push($valor, $nome_campo){
		if(gettype($this->$nome_campo) == "array") array_push($this->$nome_campo, $valor);
	}

	public function removeQuebra($tipo, $valor){
							$valor = 	str_replace("\"", '\'',
										str_replace("\\", '\\\\', 
										str_replace("\r", '', $valor)));
		if($tipo == 'html') return 		str_replace("\t", '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
										str_replace("\n", '<br>', $valor));
		else 				return 		str_replace("\t", ' ',
										str_replace("\n", '', $valor));
	}

	public function setOptions($option = array()){
		foreach ($option as $key => $value) {
			$this->$key = $value;
		}
	}
}

class FalseDebug extends PadraoObjeto{ 
	var $debug; 
	public function __construct($msm){
		if(!empty($msm) && gettype($msm) == 'string') $this->set($msm,'debug');
	}
}
?>