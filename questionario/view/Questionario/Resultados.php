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
	
	if (isset($_GET['q'])) {
		$nome = filter_input(INPUT_GET,'q',FILTER_SANITIZE_SPECIAL_CHARS);
		$questionario = DaoQuestionario::findByNome($nome);
		
		if(!empty($questionario->id)){
			$perguntas = $questionario->getPerguntas();
		}
	}else{
		Header('Location:Listar.php');
	}
?>

<!DOCTYPE html>
<html>
	<?php Template::getHeaders('Questionario: '.$questionario->nome);?>
	
	<body>
		<div class="container-fluid">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $questionario->nome; ?></div>
					<?php
						foreach($perguntas as $pergunta){
							$respostas = $pergunta->getRespostas();
							if(!empty($respostas)){
								echo '<div id="c'.$pergunta->id.'"></div>';
								echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
							}
						}
					?>
				</div>
			</div>
		</div>
	</body>
<html>

<!-- I've created a monster, ‘cause nobody wants to‘ -->
<?php 
	$dataPoints = array();
	
	foreach($perguntas as $pergunta){
		$respostas = $pergunta->getRespostas();
		$data = array();
		
		if(!empty($respostas)){
			foreach($respostas as $resposta){
				if($questionario->total != 0  && $resposta->votos){
					$porcentagem = ($resposta->votos * 100) / $questionario->total;
					$data[] = array("label"=> $resposta->texto, "y"=> $porcentagem);
				}else{
					$data[] = array("label"=> $resposta->texto, "y"=> 0);
				}
			}
			
			echo '<script>';
				echo 'var t'.$pergunta->id.'='. '"'.$pergunta->texto.'";';
				echo 'var d'.$pergunta->id.'='. json_encode($data, JSON_NUMERIC_CHECK) . ';';
			
				echo 'var canvas'.$pergunta->id.' = new CanvasJS.Chart("c'.$pergunta->id.'", {
							theme: "light2", // "light1", "light2", "dark1", "dark2"
							exportEnabled: true,
							animationEnabled: true,
							title: {
								text: t'.$pergunta->id.'
							},
							data: [{
								type: "pie",
								startAngle: 25,
								toolTipContent: "<b>{label}</b>: {y}%",
								showInLegend: "true",
								legendText: "{label}",
								indexLabelFontSize: 16,
								indexLabel: "{label} - {y}%",
								dataPoints: d'.$pergunta->id.'
							}]
						});
					';
			echo '</script>';
		}
	}
	
	foreach($perguntas as $pergunta){
			echo '<script>canvas'.$pergunta->id.'.render();</script>';
	}
?>