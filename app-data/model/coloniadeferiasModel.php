<?php

	class coloniadeferias {

		public $id;
		public $tipo;
		public $titulo;
		public $valorUm;
		public $valorDois;

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

		public function setValorUm($valorUm){
			$this->valorUm = $valorUm;
	        return $this;
		}

		public function setValorDois($valorDois){
			$this->valorDois = $valorDois;
	        return $this;
		}


	}

?>