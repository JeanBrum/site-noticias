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
		$sqlDelete = $PDO->prepare("DELETE FROM usuarios WHERE id=?");
		$exec = $sqlDelete->execute(array($id));	
	}
	else
	{
		?>
		<script>
		if (confirm("Tem certeza que deseja apagar?"))
		{
			window.location.href = "excluir_u.php?id=<?=$id?>&confirm=1"; // Ok
		}
		else
		{
			window.location.href = "index_u.php"; // Cancelar
		}
		</script>
		<?php
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Excluir Usuário</title>
	<link rel="stylesheet" href="css/estilo.css?time=<?=time()?>">
</head>
<body>
	<?php
	if ($exec)
	{
		?>
		<p class="ok">Usuário excluído com Sucesso!</p>
		<p><a href="index_u.php">Voltar</a></p>
		<?php
	}
	else
	{
		?>
		<p class="erro">Erro ao excluir o usuário!</p>
		<p><a href="index_u.php">Voltar</a></p>
		<?php
	}
	?>
</body>
</html>