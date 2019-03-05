<?php
	class Resposta{
		public $id;
		public $texto;
		public $pergunta;
		public $votos;
		
		public function getPerguntas(){
			$result = DaoResposta::getPerguntas($this->pergunta);
			return $result;
		}
		
		public function sanitize(){
            $this->id = 	filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
            $this->texto = 	$this->htmlFilter($this->texto);
            $this->pergunta = filter_var($this->pergunta, FILTER_SANITIZE_NUMBER_INT);
            $this->votos = 	filter_var($this->votos, FILTER_SANITIZE_NUMBER_INT);
		}
	}
?>