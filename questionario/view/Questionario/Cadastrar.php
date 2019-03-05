<?php
	require_once '../../Conexao.php';
	require  SITE_PATH .'/template/default/template.php';
	session_start();
	
	if(!isset($_SESSION['email'])){
		Header('Location:../Usuario/Login.php?message=2');
	}
?>

<!DOCTYPE html>
<html>
	<?php Template::getHeaders('Cadastrar Questionario'); ?>
	
	<?php 
		if(!empty($_GET['message'])){
			if($_GET['message'] == 1){
				echo '<div class="alert alert-danger fade in" id="1">';
					if(!empty($_GET['nome'])){
						echo 'Erro questionario: '. $_GET['nome'] .' já existe';
					}
					echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
				echo '</div>';
			}
		}
	?>
	
	<body>
		<div class="conteudo">
			<div class="modulo">
				<h1>Adicionar Questionario</h1>
				<form class="form" method="post"action="Cadastrar_bd.php" accept-charset="UTF-8">
					<input type="text" placeholder="Questionario:" name="nome"  required checked="checked">	
					<input type="submit" placeholder="Enviar:" name="enviar">		
				</form>
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