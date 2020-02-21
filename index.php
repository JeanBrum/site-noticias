<?php
	$PDO = new PDO("sqlite:dados.db");
?>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Site de Notícias</title>
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
	<link rel="stylesheet" href="css/estilo.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
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
		
		<!-- notícia principal -->
		<?php
			$sqlNoticiaPrincipal = $PDO->prepare("SELECT * FROM noticias ORDER BY data DESC LIMIT 1");
			$sqlNoticiaPrincipal->execute();
			$noticiaPrincipal = $sqlNoticiaPrincipal->fetchAll();
		?>
		<div class="grid-100">
			<p>Em Destaque</p>
			<div class="grid-30"><img src="fotos/<?=$noticiaPrincipal[0]["id"]?>.jpg" width="100%" alt="imagem"></div>
			<div class="grid-70">
				<p><?=date("d/m/Y", $noticiaPrincipal[0]["data"])?> | <?=$noticiaPrincipal[0]["categoria"]?></p>
				<h1><?=$noticiaPrincipal[0]["titulo"]?></h1>
				<p><?=substr(strip_tags($noticiaPrincipal[0]["texto"]), 0, 200)?> ...</p>
				<p><a href="ler.php?id=<?=$noticiaPrincipal[0]["id"]?>">+ Leia Mais</a></p>
			</div>
		</div>
		<!-- notícia principal -->
		
		<h2>Outras Notícias</h2>
		
		<div class="grid-100">
			<?php
				$sqlOutras = $PDO->prepare("SELECT * FROM noticias ORDER BY data DESC LIMIT 3 OFFSET 1");
				$sqlOutras->execute();
				$dadosOutras = $sqlOutras->fetchAll();
				foreach ($dadosOutras as $outras)
				{			
				?>						
				<div class="grid-33">
					<p><img src="fotos/<?=$outras["id"]?>.jpg" width="100%" alt="imagem"></p>
					<p><?=date("d/m/Y", $outras["data"])?> | <?=$outras["categoria"]?></p>
					<h3><?=$outras["titulo"]?></h3>
					<p><a href="ler.php?id=<?=$outras["id"]?>">+ Leia Mais</a></p>			
				</div>
				<?php
				}
			?>		
		</div>		
		
	</div>
</body>
</html>








