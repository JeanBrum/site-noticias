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
	$id = $_GET["id"];
	
	// Sql
	$sqlSelect = $PDO->prepare("SELECT * FROM noticias WHERE id=?");
	$sqlSelect->execute(array($id));
	$dados = $sqlSelect->fetchAll();
	//var_dump($dados);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Editar Notícia</title>
	<link rel="stylesheet" href="css/estilo.css?time=<?=time()?>">
	<link rel="stylesheet" href="css/unsemantic-grid-responsive.css">
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>tinymce.init({selector:'textarea',height:300});</script>
	<script  src="https://code.jquery.com/jquery-3.4.1.min.js"

  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="

  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>
<body>
<h1>Editar Notícia</h1>
<form name="frmAdicionar" method="post" action="editar.php">
<div class="grid-container">
	<div class="grid-100">
		<div class="grid-20" style="text-align:right">Título:</div>
		<div class="grid-80"><input type="text" name="titulo" maxlength="100" required="required" autofocus="autofocus" value="<?=$dados[0]["titulo"]?>"></div>
	</div>
	<div class="grid-100">
		<div class="grid-20" style="text-align:right">Categoria:</div>
		<div class="grid-80">
		<select name="categoria">
			<option value="Geral">Geral</option>
			<option value="Polícia">Polícia</option>
			<option value="Esportes">Esportes</option>
			<option value="Tecnologia">Tecnologia</option>
			<option value="Educação">Educação</option>
		</select>
		</div>
	</div>
	<div class="grid-100">
		<div class="grid-20" style="text-align:right">Texto:</div>
		<div class="grid-80">
		<textarea name="texto"><?=$dados[0]["texto"]?></textarea>
		</div>
	</div>
	<div class="grid-100">
		<div class="grid-20" style="text-align:right">Data:</div>
		<div class="grid-80">	
		<input type="text" name="data" value="<?=date("d/m/Y", $dados[0]["data"])?>">
		<!--<input type="date" name="data" value="<?=date("Y-m-d", $dados[0]["data"])?>">-->
		</div>
	</div>
	<div class="grid-100">
		<div class="grid-20">&nbsp;</div>
		<div class="grid-80"><input type="submit" value="Enviar"></div>
	</div>
</div>
<input type="hidden" name="id" value="<?=$id?>">
</form>
<script>
$(document).ready(function(){
  $('select[name=categoria]').val("<?=$dados[0]["categoria"]?>");
  $('input[name=data]').mask('00/00/0000');
});
</script>
</body>
</html>