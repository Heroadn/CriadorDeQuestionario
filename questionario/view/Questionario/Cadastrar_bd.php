<?php
	require_once '../../Conexao.php';
	require  SITE_PATH .'/template/default/template.php';
	require_once SITE_PATH .'/core/Dao/DaoPergunta.php';
	require_once SITE_PATH .'/core/Dao/DaoResposta.php';
	require_once SITE_PATH .'/core/Dao/DaoQuestionario.php';
	require_once SITE_PATH .'/core/Model/Pergunta.php';
	require_once SITE_PATH .'/core/Model/Resposta.php';
	require_once SITE_PATH .'/core/Model/Questionario.php';
	session_start();
	
	if(!isset($_SESSION['email'])){
		Header('Location:../Usuario/Cadastrar.php?message=2');
	}

	$nome = filter_input(INPUT_POST, 'nome',FILTER_SANITIZE_STRING);
	if(isset($_POST['enviar'])){
		if($nome == DaoQuestionario::findByNome($nome)->nome){
			Header('Location:Cadastrar.php?message=1&nome='.$nome.'');
		}else{
			$questionario = new Questionario();
			$questionario->nome = $nome;
			$questionario->total = 0;
			$questionario->status = 'ABERTO';
			$questionario->usuario = $_SESSION['id'];
			DaoQuestionario::save($questionario);
			header("location:Listar.php");
		}
	}
?>