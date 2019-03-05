<?php
	require_once '../../Conexao.php';
	require  SITE_PATH .'/template/default/template.php';
?>

<html>
	<?php Template::getHeaders('Cadastrar Resposta'); ?>
	
	<body>
		<div class="conteudo">
			<div class="modulo">
				<h1>Login</h1>
				<form class="form" method="post" action="Login_bd.php" accept-charset="UTF-8">
					<input type="text" placeholder="Email:" name="email"  required checked="checked">
					<input type="password" placeholder="Senha:" name="senha"  required checked="checked">
					<input type="submit" placeholder="Enviar:" name="enviar">		
				</form>
				<button type="button" id="addCadastrar" data-toggle="modal" data-target="#cadastrar" title="Cadastrar" class="btn btn-primary">Cadastrar</button>
			</div>
		</div>
		
		<div id="cadastrar" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Adicionar Pergunta</h4>
			  </div>
			  <div class="modal-body">
				<p><iframe width = "100%" height = "50%" src="../Usuario/Cadastrar.php"></iframe></p>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
	</body>
<html>