<?php
	session_start();
	if ($_SESSION["acesso"] != true)
	{
		// Não está autenticado
		$mensagem = urlencode("Você precisa fazer login!");
		header("Location:frmLogin.php?msg=$mensagem");
		exit;
	}
	
	// Conexão
	$PDO = new PDO("sqlite:../dados.db"); // Recua um diretório
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inserir Notícia</title>
	<link rel="stylesheet" href="css/estilo.css?time=<?=time()?>">
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>tinymce.init({selector:'textarea',height:300});</script>
</head>
<body>
<h1>Inserir Notícia</h1>
<form name="frmAdicionar" method="post" action="adicionar.php">
<div class="grid-container">
	<div class="grid-100">
		<div class="grid-20" style="text-align:right">Título:</div>
		<div class="grid-80"><input type="text" name="titulo" maxlength="100" required="required" autofocus="autofocus"></div>
	</div>
	<div class="grid-100">
		<div class="grid-20" style="text-align:right">Categoria:</div>
		<div class="grid-80">
		<select name="categoria">
			<option value="Geral">Geral</option>
			<option value="Polícia">Polícia</option>
			<option value="Esportes">Esportes</option>
			<option value="Tecnologia">Tecnologia</option>
			<option value="Educação">Educação</option>
		</select>
		</div>
	</div>
	<div class="grid-100">
		<div class="grid-20" style="text-align:right">Texto:</div>
		<div class="grid-80">
		<textarea name="texto"></textarea>		
		</div>
	</div>
	<div class="grid-100">
		<div class="grid-20">&nbsp;</div>
		<div class="grid-80"><input type="submit" value="Enviar"></div>
	</div>
</div>
</form>
</body>
</html>