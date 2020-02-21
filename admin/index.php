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
<h1>Cadastro de Notícias</h1>
<p><a href="frmAdicionar.php">+ Adicionar Notícia</a> | <a href="index_u.php">Cadastro de Usuários</a> | <a href="logoff.php">Sair</a></p>
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>Título</th>
			<th>Categoria</th>
			<th>Data</th>
			<th>Acessos</th>
			<th>Foto</th>
			<th>Excluir</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$sql = $PDO->prepare("SELECT * FROM noticias ORDER BY data DESC");
		$sql->execute();
		$dados = $sql->fetchAll();
		foreach ($dados as $d)
		{
			?>
			<tr>
				<td><?=$d["id"]?></td>
				<td><a href="frmEditar.php?id=<?=$d["id"]?>"><?=$d["titulo"]?></a></td>
				<td><?=$d["categoria"]?></td>
				<td><?=date("d/m/Y", $d["data"])?></td>
				<td><?=$d["acessos"]?></td>
				<td><a href="frmFoto.php?id=<?=$d["id"]?>">Foto</a></td>
				<td><a href="excluir.php?id=<?=$d["id"]?>">Excluir</a></td>
			</tr>
			<?php
		}
	?>
	</tbody>
</table>
<p>Total de Registro(s): <?=count($dados)?></p>
</body>
</html>




