<?php
	/*
	 @Author Heroadn
	*/
	class DaoQuestionario{
		private $instance;
		
		public function getInstance(){
			if(!isset(self::$instance))
				self::$instance = new DaoQuestionario();
			return self::$instance;
		}
		
		public function save(Questionario $questionario){
			try{
				$sql ="INSERT INTO questionario(
					nome,
					total,
					status,
					id_usuario) 
					VALUES(
						:nome,
						:total,
						:status,
						:id_usuario
					);";
					
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindValue(':nome',  $questionario->nome);
				$p_sql->bindValue(':total', $questionario->total);
				$p_sql->bindValue(':status',  $questionario->status);
				$p_sql->bindValue(':id_usuario', $questionario->usuario);
				return $p_sql->execute(); 
			}catch(PDOException $e){
				file_put_contents("erros.txt",
				$e->getMessage().'\r\n',
				FILE_APPEND);
			}
		}
		
		public function update(Questionario $questionario){
			try{
				$sql = 'UPDATE questionario set
							nome = :nome,
							total = :total,
							status = :status,
							id_usuario = :usuario
						WHERE id = :id';
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindValue(':id',$questionario->id);
				$p_sql->bindValue(':nome',$questionario->nome);
				$p_sql->bindValue(':total',$questionario->total);
				$p_sql->bindValue(':status',$questionario->status);
				$p_sql->bindValue(':usuario',$questionario->usuario);
				return $p_sql->execute(); 
			}catch(PDOException $e){
				file_put_contents("erros.txt",
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		public function findById($id){
			try{
				$sql = 'SELECT * FROM questionario
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
		
		public function findByNome($nome){
			try{
				$sql = 'SELECT * FROM questionario
							WHERE nome LIKE :nome';
				
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindParam(':nome',$nome);
				$p_sql->execute();
				
				$obj = self::toModel($p_sql->fetch(PDO::FETCH_ASSOC));
				return $obj;
			}catch(PDOException $e){
				file_put_contents("erros.txt",
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		public function delete($id){
			try{
				$sql = 'DELETE FROM questionario WHERE id = :id ';
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
				$sql = 'SELECT * FROM questionario';
				$p_sql = Conexao::getInstance()->query($sql);
				$models = $p_sql->fetchAll(PDO::FETCH_OBJ);
				
				return $models;
			}catch(PDOException $e){
				file_put_contents("erros.txt",
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		public function toModel($row){
			$questionario = new Questionario();
			$questionario->id = $row['id'];
			$questionario->nome = $row['nome'];
			$questionario->total = $row['total'];
			$questionario->status = $row['status'];
			$questionario->usuario = $row['id_usuario'];
			if(empty($row)){ 
				return false;
			}
			return $questionario;
		}
	}
?>