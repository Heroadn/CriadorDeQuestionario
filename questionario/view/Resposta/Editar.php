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
		Header('Location:../Usuario/Login.php?message=2');
	}

	if(isset($_POST['enviar'])){
		$resposta = new Resposta();
		$resposta->texto = filter_input(INPUT_POST, 'texto',FILTER_SANITIZE_SPECIAL_CHARS);
		$resposta->pergunta = filter_input(INPUT_POST,'pergunta',FILTER_SANITIZE_SPECIAL_CHARS);
		$resposta->votos = 0;
		DaoResposta::save($resposta);
	}
	
	$perguntas =  DaoPergunta::findAll();
	$options = "";

	foreach($perguntas as $pergunta){
		$questionario = DaoQuestionario::findById($pergunta->id_questionario);
		if($questionario->usuario == $_SESSION['id']){
			$options = $options .'<option value="'.$pergunta->id.'">'.$pergunta->texto.'</option>';
		}
	}
?>

<!DOCTYPE html>
<html>
	<?php Template::getHeaders('Cadastrar Resposta'); ?>
	
	<body>
		<div class="conteudo">
			<div class="modulo">
				<h1>Adicionar Resposta</h1>
				<form class="form" method="post" accept-charset="UTF-8">
					<input type="text" placeholder="Resposta:" name="texto"  required checked="checked">
					Selecione a pergunta:
					<select multiple="multiple" name="pergunta" required checked="checked"><?php echo $options;?></select>
					<input type="submit" placeholder="Enviar:" name="enviar">		
				</form>
			</div>
		</div>
	</body>
<html>