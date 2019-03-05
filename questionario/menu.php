<nav>
	<div>
		<h1 class="logo">Blog</h1>
		
		<ul>
			<li id="nav-toogle">
				&#9776;
			</li>
			
			<?php 
				if(isset($_SESSION['username'])){
					echo '<li>
							<a class="nav-link" href="../Usuario/usuario_sair.php">
								SAIR
							</a>
						  </li>';
				}else{
					echo '<li>
							<a class="nav-link" href="../Usuario/usuario_login.php">
								ENTRAR
							</a>
						  </li>';
				}
			?>
			<hr id="divisoria">
			
			<li>
				<!--
				<a class="nav-link" href="../Usuario/usuario_cadastrar.php">
					ADMINISTRAÇÂO
				</a>
				<hr id="divisoria">
				-->
				
				<ul>
					<li>
						<a class="nav-link" href="../Usuario/usuario_cadastrar.php">
							REGISTRO	
						</a>
					</li>
					<hr id="divisoria">
					<li>
						<a class="nav-link" href="#">
							COMENTARIOS
						</a>
					</li>
					<hr id="divisoria">
					<li>
						<a class="nav-link" href="../Post/post_cadastrar.php">
							CADASTRAR POST
						</a>
					</li>
					<hr id="divisoria">
				</ul>
			</li>
		</ul>
		<hr id="dashed">
		
	</div>
</nav>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace()
</script>