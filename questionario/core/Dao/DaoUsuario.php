<?php
	class DaoUsuario{
		public $instance;
		
		public function getInstance(){
			if(!isset(self::$instance))
				self::$instance = new DaoUsuario();
			return self::$instance;
		}
		
		public static function save($usuario){
			try{
				$sql ='INSERT INTO usuario(
							email,
							senha
						)
						VALUES(
							:email,
							:senha
						)';
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindParam(':email',$usuario->email);
				$p_sql->bindParam(':senha',$usuario->senha);
				return $p_sql->execute();
			}catch(PDOException $e){
				file_put_contents("erros.txt",
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		public function update($usuario){
			try{
				$sql = 'UPDATE resposta SET 
							email = :email,
							senha = :senha
						WHERE id = :id';
				$p_sql = Conexao::getInstance()->prepare($sql);
				$p_sql->bindParam(':id',$usuario->id);
				$p_sql->bindParam(':email',$usuario->email);
				$p_sql->bindParam(':senha',$usuario->senha);
				return $p_sql->execute();
			}catch(PDOException $e){
				file_put_contents("erros.txt",	
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		public function findById($id){
			try{		
				$sql = 'SELECT * FROM usuario
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
		
		public function findByEmail($email){
			try{
				#codigo a ser execultado
				$sql = 'SELECT * FROM usuario
							WHERE email = :email
							LIMIT 1';
							
				#requerindo Conexao
				$p_sql = Conexao::getInstance()->prepare($sql);
				
				#trocando parametros
				$p_sql->bindParam(':email',$email);
				
				#execultar
				$p_sql->execute();
				
				#retornar como um pojo
				return self::toModel($p_sql->fetch(PDO::FETCH_ASSOC));
			}catch(PDOException $e){
				#em caso de erro registre num log 
				file_put_contents("erros.txt",
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		public function delete($id){
			try{
				$sql = 'DELETE FROM usuario WHERE id = :id ';
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
				$sql = 'SELECT * FROM usuario';
					
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
			$model = new Usuario();
			$model->id = $row['id'];
			$model->email = $row['email'];
			$model->senha = $row['senha'];
			return $model;
		}
	}