<?php
	class DaoResposta{
		public $instance;
		
		public function getInstance(){
			if(!isset(self::$instance))
				self::$instance = new DaoResposta();
			return self::$instance;
		}
		
		public static function save($resposta){
			try{
				$sql ='INSERT INTO resposta(
							texto,
							votos,
							id_pergunta
						)
						VALUES(
							:texto,
							:votos,
							:id_pergunta
						)';
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindParam(':texto',$resposta->texto);
				$p_sql->bindParam(':votos',$resposta->votos);
				$p_sql->bindParam(':id_pergunta',$resposta->pergunta);
				return $p_sql->execute();
			}catch(PDOException $e){
				file_put_contents("erros.txt",
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		public function update($resposta){
			try{
				$sql = 'UPDATE resposta SET 
							texto = :texto,
							votos = :votos,
							id_pergunta = :id_pergunta
						WHERE id = :id';
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindParam(':id',$resposta->id);
				$p_sql->bindParam(':texto',$resposta->texto);
				$p_sql->bindParam(':votos',$resposta->votos);
				$p_sql->bindParam(':id_pergunta',$resposta->pergunta);
				return $p_sql->execute();
			}catch(PDOException $e){
				file_put_contents("erros.txt",	
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		public function findById($id){
			try{		
				$sql = 'SELECT * FROM resposta
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
				$sql = 'DELETE FROM resposta WHERE id = :id ';
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindParam(':id',$id);
				
				return $p_sql->execute();
			}catch(PDOException $e){
				file_put_contents("erros.txt",
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		public static function findAll(){
			$models = array();
			
			try{		
				$sql = 'SELECT * FROM resposta';
					
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
				$sql = 'SELECT * FROM pergunta WHERE id = :id';
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
		
		public static function getRespostas($id){
			$models = array();
			
			try{		
				$sql = 'SELECT * FROM resposta where id_pergunta = :id';
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
			$model = new Resposta();
			$model->id = $row['id'];
			$model->texto = $row['texto'];
			$model->votos = $row['votos'];
			$model->pergunta = $row['id_pergunta'];
			return $model;
		}
	}