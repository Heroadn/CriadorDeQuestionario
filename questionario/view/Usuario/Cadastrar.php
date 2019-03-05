<?php
	require_once '../../Conexao.php';
	require  SITE_PATH .'/template/default/template.php';
	
	//message = 1 Já Existe
	//message = 2 Necessario Registro
	//message = 3 Sucesso
?>



<!DOCTYPE html>
<html>
	<?php Template::getHeaders('Cadastrar Pergunta'); ?>
	
	<?php 
		if(!empty($_GET['message'])){
			if($_GET['message'] == 1){
				echo '<div class="alert alert-danger fade in" id="alert">';
					echo 'Conta Já Existe';
					echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
				echo '</div>';
			}
			
			if($_GET['message'] == 2){
				echo '<div class="alert alert-danger fade in" id="alert">';
					echo 'É necessario cadastro para realizar a Ação';
					echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
				echo '</div>';
			}
		}
	?>
	
	<body>
		<div class="conteudo">
			<div class="modulo">
				<h1>Cadastrar Usuario</h1>
				<form class="form" method="post" action="Cadastrar_bd.php" accept-charset="UTF-8">	
					<label for="email">Email</label><input type="text" placeholder="Email:" name="email" id="email" required>		
					<label for="senha">Senha</label><input type="password" placeholder="Senha:" name="senha" id="senha" required>			
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