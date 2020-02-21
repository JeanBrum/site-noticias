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
	$id 		= $_POST["id"];
	$titulo 	= $_POST["titulo"];
	$categoria 	= $_POST["categoria"];
	$texto 		= $_POST["texto"];
	//$data 		= strtotime($_POST["data"]); // se calendário
	
	// se input text	
	$data = str_replace("/", "", $_POST["data"]);	
	$data = mktime(0, 0, 0, substr($data, 2, 2), substr($data, 0, 2), substr($data, 4, 4));
	
	$sql = $PDO->prepare("UPDATE noticias SET titulo=?, categoria=?, texto=?, data=? WHERE id=?");
	$exec = $sql->execute(array($titulo, $categoria, $texto, $data, $id));
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Editar Notícia</title>
	<link rel="stylesheet" href="css/estilo.css?time=<?=time()?>">
</head>
<body>
	<?php
	if ($exec)
	{
		?>
		<p class="ok">Notícia Alterada com Sucesso!</p>
		<p><a href="index.php">Voltar</a></p>
		<?php
	}
	else
	{
		?>
		<p class="erro">Erro ao alterar a notícia!</p>
		<p><a href="frmEditar.php?id=<?=$id?>">Voltar</a></p>
		<?php
	}
	?>
</body>
</html>