<?php
	$PDO = new PDO("sqlite:dados.db");
	
	$titulo = $_POST["titulo"];
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
		
		<h2>Pesquisa</h2>
		
		<div class="grid-100">
			<?php
				$sqlPesquisa = $PDO->prepare("SELECT * FROM noticias WHERE titulo LIKE ? OR texto LIKE ?");
				$sqlPesquisa->execute(array("%$titulo%", "%$titulo%"));
				$dadosPesquisa = $sqlPesquisa->fetchAll();

				foreach ($dadosPesquisa as $pesquisa)
				{			
				?>						
				<div class="grid-33">
					<p><img src="fotos/<?=$pesquisa["id"]?>.jpg" width="100%" alt="imagem"></p>
					<p><?=date("d/m/Y", $pesquisa["data"])?> | <?=$pesquisa["categoria"]?></p>
					<h3><?=$pesquisa["titulo"]?></h3>
					<p><a href="ler.php?id=<?=$pesquisa["id"]?>">+ Leia Mais</a></p>			
				</div>
				<?php
				}
			?>		
		</div>		
		
	</div>
</body>
</html>








