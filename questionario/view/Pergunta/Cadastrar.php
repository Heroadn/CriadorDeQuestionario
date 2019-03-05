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

	if(isset($_POST['enviar'])){
		$pergunta = new Pergunta();
		$pergunta->texto = filter_input(INPUT_POST, 'texto',FILTER_SANITIZE_STRING);
		$pergunta->questionario = filter_input(INPUT_POST,'questionario',FILTER_SANITIZE_SPECIAL_CHARS);
		DaoPergunta::save($pergunta);
		//header("location:../../");
	}
	
	$questionarios =  DaoQuestionario::findAll();
	$options = "";
	
	foreach($questionarios as $questionario){
		if($_SESSION['id'] == $questionario->id_usuario){
			$options = $options .'<option value="'.$questionario->id.'">'.$questionario->nome.'</option>';
		}
	}
?>

<!DOCTYPE html>
<html>
	<?php Template::getHeaders('Cadastrar Pergunta'); ?>
	
	<body>
		<div class="conteudo">
			<div class="modulo">
				<h1>Adicionar Pergunta</h1>
				<form class="form" method="post" accept-charset="UTF-8">
					<input type="text" placeholder="Pergunta:" name="texto"  required checked="checked">
					Selecione o Questionario:
					<select multiple="multiple" name="questionario" required checked="checked"><?php echo $options;?></select>
					<input type="submit" placeholder="Enviar:" name="enviar">		
				</form>
			</div>
		</div>
	</body>
<html>