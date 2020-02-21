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
	$login = $_POST["login"];
	$senha = md5($_POST["senha"]);
	
	// SQL
	$sql = $PDO->prepare("INSERT INTO usuarios (login, senha) VALUES (?, ?)");
	$exec = $sql->execute(array($login, $senha));	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inserir Usuário</title>
	<link rel="stylesheet" href="css/estilo.css?time=<?=time()?>">
</head>
<body>
	<?php
	if ($exec)
	{
		?>
		<p class="ok">Usuário Inserido com Sucesso!</p>
		<p><a href="index_u.php">Voltar</a></p>
		<?php
	}
	else
	{
		?>
		<p class="erro">Erro ao inserir o usuário!</p>
		<p><a href="frmAdicionar_u.php">Voltar</a></p>
		<?php
	}
	?>
</body>
</html>