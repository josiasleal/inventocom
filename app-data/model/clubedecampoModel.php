<?php

	class clubedecampo {

		public $id;
		public $tipo;
		public $titulo;
		public $valor;

		public function setId($id){
			$this->id = $id;
	        return $this;
		}

		public function setTipo($tipo){
			$this->tipo = $tipo;
	        return $this;
		}

		public function setTitulo($titulo){
			$this->titulo = $titulo;
	        return $this;
		}

		public function setValor($valor){
			$this->valor = $valor;
	        return $this;
		}		

		// public function getStatus(){
		// 	return $this->status = $status;
		// }


	}

?>