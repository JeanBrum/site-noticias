<?php
	$PDO = new PDO("sqlite:dados.db");
	
	$id = $_GET["id"]; // pega o id da notícia na urldecode
	
	$sqlNoticia = $PDO->prepare("SELECT * FROM noticias WHERE id=?");
	$sqlNoticia->execute(array($id));
	$noticia = $sqlNoticia->fetchAll(); // dados
	
	// aumentar acessos + 1
	$sqlUpdate = $PDO->prepare("UPDATE noticias SET acessos=acessos+1 WHERE id=?");
	$sqlUpdate->execute(array($id));
?>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title><?=$noticia[0]["titulo"]?></title>
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="css/estilo.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
	<div class="grid-container">
		<div class="grid-container">
		<div class="grid-25 mobile-grid-100" style="text-align:center">
			<div class="grid-100 hide-on-mobile">
			<p>&nbsp;</p>
			</div>			
			<a href="index.php"><img src="img/logotipo1.png" alt="Logo Univates" width="100%"></a>
			<p><?=date("d/m/Y")?></p>
		</div>
		<div id="banner" class="grid-75 mobile-grid-100">			
		</div>
		
		<!-- barra pesquisa -->
		<div id="pesquisa" class="grid-100">
			<div class="grid-50"><a href="index.php">Página inicial</a></div>
			<div class="grid-50" style="text-align:right">
				Pesquisar:
				<form name="frmPesquisar" action="pesquisar.php" method="post">
					<input type="text" name="titulo">
					<input type="submit" value="OK">
				</form>
			</div>			
		</div>
		<!-- barra pesquisa -->
		
		<h1><?=$noticia[0]["titulo"]?></h1>
		<p><img src="fotos/<?=$noticia[0]["id"]?>.jpg" alt="foto" width="100%"></p>
		<p><?=$noticia[0]["texto"]?></p>
		<p>Data: <?=date("d/m/Y", $noticia[0]["data"])?></p>
		<p>Categoria: <?=$noticia[0]["categoria"]?></p>
	</div>
</body>
</html>








