<?php
	/*
	 @Author Heroadn
	*/
	class DaoPergunta{
		public $conexao;
		
		public static function getInstance(){
			if(!isset(self::$instance))
					self::$instance = new DaoPergunta();
			return self::$instance;
		}
		
		public function save($pergunta){
			try{
				$sql ="INSERT INTO pergunta(
							texto,
							id_questionario
						) 
						VALUES(
							:texto,
							:id_questionario
						);";
					
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindValue(":texto", $pergunta->texto);
				$p_sql->bindValue(":id_questionario", $pergunta->questionario);
				return $p_sql->execute(); 
			}catch(PDOException $e){
				file_put_contents("erros.txt",
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		
		public function update($pergunta){
			try{
				
				$sql = 'UPDATE resposta SET 
							texto = :texto,
							id_questionario = :id_questionario
						WHERE id = :id';
				$p_sql = Conexao::getInstance()-prepare($sql);
				$p_sql->bindParam(':texto',$pergunta->texto);
				$p_sql->bindParam(':id_questionario',$pergunta->questionario);
			}catch(PDOException $e){
				file_put_contents("erros.txt",	
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		public function findById($id){
			try{		
				$sql = 'SELECT * FROM pergunta
					WHERE id = :id';
					
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindParam(':id',$id);
				$p_sql->execute();
				return self::toModel($p_sql->fetch(PDO::FETCH_ASSOC));
			}catch(PDOException $e){
				file_put_contents("erros.txt",
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		public function delete($id){
			try{
				$sql = 'DELETE FROM pergunta WHERE id = :id ';
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindParam(':id',$id);
				return $p_sql->execute();
			}catch(PDOException $e){
				file_put_contents("erros.txt",
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		public  static function findAll(){
			$models = array();
			
			try{		
				$sql = 'SELECT * FROM pergunta';
					
				$p_sql = Conexao::getInstance()->query($sql);
				$models = $p_sql->fetchAll(PDO::FETCH_OBJ);
				
				return $models;
			}catch(PDOException $e){
				file_put_contents("erros.txt",
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		public  static function getPerguntas($id){
			$models = array();
			
			try{		
				$sql = 'SELECT * FROM pergunta WHERE id_questionario = :id';
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindParam(':id',$id);
				$p_sql->execute();
				
				$objects = $p_sql->fetchAll(PDO::FETCH_ASSOC);
				foreach($objects as $model){
					$models[] = self::toModel($model);
				}

				return $models;
			}catch(PDOException $e){
				file_put_contents("erros.txt",
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		public function toModel($row){
			$model = new Pergunta();
			$model->id = $row['id'];
			$model->texto = $row['texto'];
			$model->pergunta = $row['id_questionario'];
			return $model;
		}
		
		/*
		public  static function getQuestionario($id){
			$models = array();
			
			try{		
				$sql = 'SELECT * FROM questionario WHERE id_questionario = :id';
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindParam(':id',$id);
				$p_sql->execute();
				$models = $p_sql->fetchAll(PDO::FETCH_OBJ);
				
				foreach($models as $model){
					$models[] = $model;
				}
				
				return $models;
			}catch(PDOException $e){
				file_put_contents("erros.txt",
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}*/
	}

?>