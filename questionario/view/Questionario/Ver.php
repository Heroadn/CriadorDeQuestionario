<?php
	require_once '../../Conexao.php';
	require  SITE_PATH .'/template/default/template.php';
	require_once SITE_PATH .'/core/Dao/DaoPergunta.php';
	require_once SITE_PATH .'/core/Dao/DaoResposta.php';
	require_once SITE_PATH .'/core/Dao/DaoQuestionario.php';
	require_once SITE_PATH .'/core/Model/Pergunta.php';
	require_once SITE_PATH .'/core/Model/Resposta.php';
	require_once SITE_PATH .'/core/Model/Questionario.php';
	$questionario = null;
	$perguntas = null;
	$respostas = null;
	session_start();
	
	if (isset($_GET['q'])) {
		$nome = filter_input(INPUT_GET,'q',FILTER_SANITIZE_SPECIAL_CHARS);
		$questionario = DaoQuestionario::findByNome($nome);
		
		if(!empty($questionario->id)){
			$perguntas = $questionario->getPerguntas();
			
			if(isset($_SESSION['Q'.$questionario->id])){
				/*Se o Usuario já realizou o questionario*/
				if($_SESSION['Q'.$questionario->id] == 1){
					Header('Location:Listar.php?message=5');
				}
			}
		}
	}else{
		Header('Location:Listar.php');
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$_SESSION['Q'.$questionario->id] = true;
		
		foreach($perguntas as $pergunta){
			$button =  filter_input(INPUT_POST,'R'.$pergunta->id,FILTER_SANITIZE_NUMBER_INT);
			$resposta = DaoResposta::findById($button);
			
			$resposta->votos += 1;
			DaoResposta::update($resposta);
		}
		
		$questionario->total +=1;
		
		DaoQuestionario::update($questionario);
		header("location:Resultados.php?q=" . $questionario->nome);
	}
?>

<!DOCTYPE html>
<html>
	<?php Template::getHeaders('Questionario: '.$questionario->nome); ?>
	
	<body>
		<div class="container-fluid">
			<div class="panel panel-default">
			<div class="panel-heading"><?php echo $questionario->nome ?></div>
				<div class="panel-body">
					<form class="form" method="post" accept-charset="UTF-8">
						<?php 
							$x = 0;
							foreach($perguntas as $pergunta){
								echo '<br>';
								
								$respostas = $pergunta->getRespostas();
								if(!empty($respostas)){
									if($x > 2){
										echo '<div class="panel panel-info">';
									}else{
										echo '<div class="panel panel-success">';
									}
										echo '<div class="panel-heading">'. $pergunta->texto .'</div>';
										echo '<div class="panel-body">';
									
											foreach($respostas as $resposta){
												echo'<input type="radio" value="'.$resposta->id.'" name="R'.$pergunta->id.'" required checked="checked">';
												echo $resposta->texto;
												echo '<br>';
											}
										echo '</div>';
									echo '</div>';
									$x++;
								}
							}
						?>
						<input type="submit" value="Enviar" placeholder="Enviar:" name="enviar">	
					</form>
				</div>
			</div>
		</div>
	</body>
<html>