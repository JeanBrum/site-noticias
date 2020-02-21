<?php
	session_start();
	if ($_SESSION["acesso"] != true)
	{
		// Não está autenticado
		$mensagem = urlencode("Você precisa fazer login!");
		header("Location:frmLogin.php?msg=$mensagem");
		exit;
	}
	
	$PDO = new PDO("sqlite:../dados.db");
	
	$id = $_GET["id"]; // Coleta Id da URL
	@$confirm = $_GET["confirm"]; // Confirmação
	
	if ($id && $confirm)
	{
		// Delete
		$sqlDelete = $PDO->prepare("DELETE FROM noticias WHERE id=?");
		$exec = $sqlDelete->execute(array($id));	
	}
	else
	{
		?>
		<script>
		if (confirm("Tem certeza que deseja apagar?"))
		{
			window.location.href = "excluir.php?id=<?=$id?>&confirm=1"; // Ok
		}
		else
		{
			window.location.href = "index.php"; // Cancelar
		}
		</script>
		<?php
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Excluir Notícia</title>
	<link rel="stylesheet" href="css/estilo.css?time=<?=time()?>">
</head>
<body>
	<?php
	if ($exec)
	{
		?>
		<p class="ok">Notícia Excluída com Sucesso!</p>
		<p><a href="index.php">Voltar</a></p>
		<?php
	}
	else
	{
		?>
		<p class="erro">Erro ao excluir a notícia!</p>
		<p><a href="frmAdicionar.php">Voltar</a></p>
		<?php
	}
	?>
</body>
</html>