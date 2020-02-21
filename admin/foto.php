<?php
	$id = $_POST["id"]; // id notícia
	$foto = $_FILES["foto"]["tmp_name"]; // foto input
	
	copy($foto, "../fotos/$id.jpg");
	
	header("Location: index.php"); // retorna para index admin
?>