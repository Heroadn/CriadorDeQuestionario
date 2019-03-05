<?php
	class Pergunta{
		
		public $id;
		public $texto;
		public $questionario;
		
		public function getQuestionario(){
			$result = DaoQuestionario::findById($this->questionario);
			return $result;
		}
		
		public function getRespostas(){
			$result = DaoResposta::getRespostas($this->id);
			return $result;
		}
	}
?>