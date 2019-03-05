<?php
	class Questionario{	
		public $id;
		public $nome;
		public $total;
		public $status;
		public $usuario;
		
		public function getPerguntas(){
			$result = DaoPergunta::getPerguntas($this->id);
			return $result;
		}
		
		public function sanitize(){
            $this->id = 	filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
            $this->nome = 	$this->htmlFilter($this->texto);
            $this->total = filter_var($this->total, FILTER_SANITIZE_NUMBER_INT);
		}
	}
?>