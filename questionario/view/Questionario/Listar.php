<?php
	require_once '../../Conexao.php';
	require  SITE_PATH .'/template/default/template.php';
	require_once SITE_PATH .'/core/Dao/DaoPergunta.php';
	require_once SITE_PATH .'/core/Dao/DaoResposta.php';
	require_once SITE_PATH .'/core/Dao/DaoQuestionario.php';
	require_once SITE_PATH .'/core/Model/Pergunta.php';
	require_once SITE_PATH .'/core/Model/Resposta.php';
	require_once SITE_PATH .'/core/Model/Questionario.php';
	
	$questionarios = DaoQuestionario::findAll();
	session_start();
?>
<!DOCTYPE html>
<html>
	<?php Template::getHeaders('Cadastrar Questionario'); ?>
	
	<body>
		
		<?php
			if (isset($_GET['message'])) {
				if(!(empty($_GET['message']) == 3)){
					if(!(empty($_GET['usuario']) == 1)){
						echo '<div class="alert alert-success fade in" id="alert">';
							echo 'Usuario registrado com sucesso';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '</div>';
					}
					
					if(!(empty($_GET['questionario']))){
						echo '<div class="alert alert-success fade in" id="alert">';
							echo 'Questionario: '.$_GET['questionario'].' registrado com sucesso';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '</div>';
					}
				}
			}
		?>
	
		<div class="container-fluid">
			<div class="panel panel-default">
				<div class="panel-heading">Selecione um questionario</div>
				<!--<i style="font-size:30px" class="fa fa-user-circle-o"></i> -->
				
				<div class="panel-body panel-body-sm">
					<?php 
						if(!empty($questionarios)){
							foreach($questionarios as $questionario){
								echo '<div class="panel panel-default">';
									echo '<div class="panel-heading" style="font-size:18px">'.'<i class="fa fa-address-book"></i>   '. $questionario->nome .'</div>';
									echo'<div class="panel-body">';
											echo '<div style="padding:5px;">';
												echo '<a href="'.'Ver.php'.'?q=' . $questionario->nome.'">';
													echo '<button style="margin-right:5px;" type="button" class="btn btn-primary">Questionario</button> ';
												echo '</a>';
												
												echo '<a href="'.'Resultados.php'.'?q=' . $questionario->nome.'">';
													echo '<button style="margin-right:8px;" type="button" class="btn btn-primary">Resultados</button>';
												echo '</a>';
													
												
												if(isset($_SESSION['email'])){
													if($_SESSION['id'] == $questionario->id_usuario){
														echo '<a href="'.'Editar.php'.'?id=' . $questionario->id.'">';
															echo '<button type="button" class="btn btn-basic"><i class="fa fa-cog" aria-hidden="true"></i></button>';
														echo '</a>';
													}
												}
											echo '</div>';
									echo '</div>';
								echo '</div>';
							}	
						}
						echo '<a href="'.'Cadastrar.php'.'">';
							echo '<button type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button>';
						echo '</a>';
					
					?>
				</div>
			</div>
		</div>
	</body>
<html>

<script type="text/javascript">
	$(document).ready(function(){
		$(".close").click(function(){
			$("#alert").alert();
		});
	});  
</script>