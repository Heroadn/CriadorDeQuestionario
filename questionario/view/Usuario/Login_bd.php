<?php
	require_once '../../Conexao.php';
	require  SITE_PATH .'/template/default/template.php';
	require_once SITE_PATH .'/core/Dao/DaoQuestionario.php';
	require_once SITE_PATH .'/core/Model/Questionario.php';
	require_once SITE_PATH .'/core/Dao/DaoUsuario.php';
	require_once SITE_PATH .'/core/Model/Usuario.php';
	
	$senha  = filter_input(INPUT_POST,'senha',FILTER_SANITIZE_SPECIAL_CHARS);
	$email  = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_EMAIL);
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($senha) && isset($email)){
			$usuario = DaoUsuario::findByEmail($email);
			
			if($email == $usuario->email && md5($senha . SALT) == $usuario->senha){
				session_start();
				#iniciando sessao segura
				session_start();
				$_SESSION['id'] 	= $usuario->id;
				$_SESSION['email']  = $usuario->email;
				Header('Location:../Questionario/Listar.php');
			}else{
				Header('Location:Login.php?message=4');
			}
		}
	}