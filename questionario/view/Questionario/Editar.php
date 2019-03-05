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
	
	if(!isset($_SESSION['email'])){
		Header('Location:../Usuario/Cadastrar.php?message=2');
	}
	
	if (isset($_GET['id'])) {
		$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_SPECIAL_CHARS);
		$questionario = DaoQuestionario::findById($id);

		if($questionario->usuario == $_SESSION['id']){	
			if(!empty($questionario->id)){
				$perguntas = $questionario->getPerguntas();
			}
		}else{
			Header('Location:Listar.php?message=4');
		}
	}else{
		Header('Location:Listar.php?message=4');
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
							foreach($perguntas as $pergunta){
								$respostas = $pergunta->getRespostas();
									echo '<div class="panel panel-info">';
										echo '<div class="panel-heading">'. $pergunta->texto .'</div>';
										echo '<div class="panel-body">';
									
											foreach($respostas as $resposta){
													echo'<input type="radio" value="'.$resposta->id.'" name="R'.$pergunta->id.'" required checked="checked">';
													echo $resposta->texto;
													echo '<button style="margin-right:8px;" value="'.$resposta->id.'" id="editarResposta" data-toggle="modal" data-target="#respostaEditarModal" type="button" class="btn btn-basic"><i class="fa fa-edit" aria-hidden="true"></i></button>';
													echo '<button style="margin-right:8px;" type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>';
													echo '<br>';
											}
											
											//Adicionar Resposta
											echo '<button type="button" id="addResposta" data-toggle="modal" data-target="#respostaModal" title="Adicionar resposta" class="btn btn-primary"><i class="fa fa-plus"></i></button>';
											
										echo '</div>';
									echo '</div>';
							}
							
							//Adicionar Pergunta
							echo '<div style="text-align:center;" class="panel">';
									echo '<button type="button" id="addPergunta" data-toggle="modal" data-target="#perguntaModal" title="Adicionar pergunta" class="btn btn-primary"><i class="fa fa-plus"></i></button>';
							echo '</div>';
						?>
					</form>
				</div>
			</div>
		</div>
		
		<div id="perguntaModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Adicionar Pergunta</h4>
			  </div>
			  <div class="modal-body">
				<p><iframe width = "100%" height = "100%" src="../Pergunta/Cadastrar.php"></iframe></p>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<div id="respostaModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Adicionar Resposta</h4>
			  </div>
			  <div class="modal-body">
				<p><iframe width = "100%" height = "100%" src="../Resposta/Cadastrar.php"></iframe></p>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<div id="respostaEditarModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Adicionar Resposta</h4>
			  </div>
			  <div class="modal-body">
				<p><iframe width = "100%" height = "100%" src="../Resposta/Editar.php?id="></iframe></p>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<div id="perguntaEditarModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Adicionar Resposta</h4>
			  </div>
			  <div class="modal-body">
				<p><iframe width = "100%" height = "100%" src="../Resposta/Cadastrar.php"></iframe></p>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
	</body>
<html>