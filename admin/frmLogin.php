<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<h1>Acesso ao Sistema</h1>
<p style="background-color:red;color:white"><?=@urldecode($_GET["msg"])?></p>

<form name="frmLogin" action="login.php" method="post">
<p>Usuário</p>
<p><input type="text" name="usuario" maxlength="50" required="required" autofocus="autofocus"></p>
<p>Senha</p>
<p><input type="password" name="senha" maxlength="50" required="required"></p>
<p><input type="submit" value="Entrar"></p>
</form>

</body>
</html>