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
	
	// Coleta Dados	
	$id = $_GET["id"];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Editar Foto</title>
	<link rel="stylesheet" href="css/estilo.css?time=<?=time()?>">
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
</head>
<body>
<h1>Editar Foto</h1>
<form name="frmFoto" method="post" action="foto.php" enctype="multipart/form-data">
<div class="grid-container">
	<div class="grid-100">
		<div class="grid-20" style="text-align:right">Foto:</div>
		<div class="grid-80"><input type="file" name="foto" required="required" autofocus="autofocus" accept=".jpg"></div>
	</div>
	<div class="grid-100">
		<div class="grid-20">&nbsp;</div>
		<div class="grid-80"><input type="submit" value="Enviar"></div>
	</div>
</div>
<input type="hidden" name="id" value="<?=$id?>">
</form>
</body>
</html>