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
	
	// Sql
	$sqlSelect = $PDO->prepare("SELECT * FROM usuarios WHERE id=?");
	$sqlSelect->execute(array($id));
	$dados = $sqlSelect->fetchAll();
	//var_dump($dados);	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Alterar Usuário</title>
	<link rel="stylesheet" href="css/estilo.css?time=<?=time()?>">
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
</head>
<body>
<h1>Alterar Usuário</h1>
<form name="frmEditar" method="post" action="editar_u.php">
<div class="grid-container">
	<div class="grid-100">
		<div class="grid-20" style="text-align:right">Login:</div>
		<div class="grid-80"><input type="text" name="login" maxlength="100" required="required" autofocus="autofocus" value="<?=$dados[0]["login"]?>"></div>
	</div>
	<div class="grid-100">
		<div class="grid-20" style="text-align:right">Senha:</div>
		<div class="grid-80"><input type="password" name="senha" maxlength="100" required="required"></div>
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