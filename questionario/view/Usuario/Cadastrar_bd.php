<?php
	require_once '../../Conexao.php';
	require  SITE_PATH .'/template/default/template.php';
	require_once SITE_PATH .'/core/Dao/DaoQuestionario.php';
	require_once SITE_PATH .'/core/Model/Questionario.php';
	require_once SITE_PATH .'/core/Dao/DaoUsuario.php';
	require_once SITE_PATH .'/core/Model/Usuario.php';
	
	#mensagem de erro
	$error_msg = '';
	
	$senha  = filter_input(INPUT_POST,'senha',FILTER_SANITIZE_SPECIAL_CHARS);
	$email  = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_EMAIL);
	$email = filter_var($email, FILTER_VALIDATE_EMAIL);
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($senha) && isset($email)){
			$usuario = DaoUsuario::findByEmail($email);
			
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$error_msg = 'Email não valido';
			}
			
			if(!empty($usuario)){
				if($usuario->email == $email){
					$error_msg = 'Conta ja existe';
				}
			}
			
			#Se estiver vazio = nenhum erro, pode processeguir
			if(empty($error_msg)){
				
				#Gerando salt aleatorio
				$randow_salt = SALT;//md5(uniqid(openssl_random_pseudo_bytes(32), true));
				
				#Criptografando senha do usuario
				$senha = md5($senha . $randow_salt);	
				#Criando objeto Usuario 
				$usuario = new Usuario();
				
				#Atribuindo informaçoes ao objeto
				$usuario->senha = $senha;
				$usuario->email = $email;
				
				#inserindo
				DaoUsuario::save($usuario);
				$fromDb = DaoUsuario::findByEmail($usuario->email);
				
				#iniciando sessao segura
				session_start();
				$_SESSION['id'] 	= $fromDb->id;
				$_SESSION['email']  = $fromDb->email;
				
				#redireciona pagina
				header('Location:../Questionario/Listar.php?message=3&usuario=1');
			}else{
				header('Location:../Usuario/Cadastrar.php?message=1');
			}
		}
	}
?>