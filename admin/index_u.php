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
<html>
<head>
	<meta charset="utf-8">
	<title>Bem-vindo</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<h1>Cadastro de Usuários</h1>
<p><a href="frmAdicionar_u.php">+ Adicionar Usuário</a> | <a href="index.php">Voltar para Notícias</a></p>
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>Login</th>
			<th>Excluir</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$sql = $PDO->prepare("SELECT * FROM usuarios ORDER BY login");
		$sql->execute();
		$dados = $sql->fetchAll();
		foreach ($dados as $d)
		{
			?>
			<tr>
				<td><?=$d["id"]?></td>
				<td><a href="frmEditar_u.php?id=<?=$d["id"]?>"><?=$d["login"]?></a></td>
				<td><a href="excluir_u.php?id=<?=$d["id"]?>">Excluir</a></td>
			</tr>
			<?php
		}
	?>
	</tbody>
</table>
</body>
</html>




