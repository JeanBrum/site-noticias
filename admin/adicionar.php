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
	$titulo = $_POST["titulo"];
	$categoria = $_POST["categoria"];
	$texto = $_POST["texto"];
	
	// SQL
	$sql = $PDO->prepare("INSERT INTO noticias (titulo, categoria, texto, data) VALUES (?, ?, ?, ?)");
	$exec = $sql->execute(array($titulo, $categoria, $texto, time()));	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inserir Notícia</title>
	<link rel="stylesheet" href="css/estilo.css?time=<?=time()?>">
</head>
<body>
	<?php
	if ($exec)
	{
		?>
		<p class="ok">Notícia Inserida com Sucesso!</p>
		<p><a href="index.php">Voltar</a></p>
		<?php
	}
	else
	{
		?>
		<p class="erro">Erro ao inserir a notícia!</p>
		<p><a href="frmAdicionar.php">Voltar</a></p>
		<?php
	}
	?>
</body>
</html>