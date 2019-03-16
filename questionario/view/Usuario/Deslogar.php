<?php
	session_start();
	session_destroy();
	Header('Location:../Questionario/Listar.php');
?>