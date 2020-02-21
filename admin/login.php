<?php
	session_start();
	
	$usuario = $_POST["usuario"]; // coleta usuário form
	$senha = md5($_POST["senha"]); // coleta senha form
	
	// Conexão
	$PDO = new PDO("sqlite:../dados.db"); // Recua um diretório
	
	$sql = $PDO->prepare("SELECT * FROM usuarios WHERE login=? AND senha=?");
	$sql->execute(array($usuario, $senha));
	$dadosUsuario = $sql->fetchAll();	
	
	if ($dadosUsuario)
	{
		$_SESSION["acesso"] = true; // flag
		$_SESSION["usuario"] = $usuario;
		header("Location:index.php");
		exit;
	}
	else
	{
		sleep(3); // para 3 segundos
		$mensagem = urlencode("Usuário e/ou senha inválidos!");
		header("Location:frmLogin.php?msg=$mensagem");
		exit; // Importante (sair)
	}
?>