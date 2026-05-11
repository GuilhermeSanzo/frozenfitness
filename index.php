<?php

	/* Verificando se a sessão já foi aberta */
  if(!isset($_SESSION)) {
    session_start();
  }

  if (!isset($_SESSION['carrinho'])) {
		$_SESSION['carrinho'] = array();
	}

	/* Verificando se a sessão já foi iniciada */
	if (!empty($_SESSION["nome"])) {
		header("location:home.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Frozen Fitness Gourmet</title>
	<meta charset="utf-8">
	<link rel="icon" type="image/gif" href="imagens/logo.png">

	<!-- Estilização Desktop -->
	<link type="text/css" rel="stylesheet" media="screen and (min-device-width: 500px)" href="css/index.css">

	<!-- Estilização Mobile -->
	<link type="text/css" rel="stylesheet" media="screen and (max-device-width: 500px)" href="css/mobile/index.css">
</head>
<body>
	<div class="corpo">
		<div class="box_superior">
			<div class="box_superior_esquerda">
				<img class="logo" src="imagens/logo.png" alt="Logo">
				<h1 class="nome_empresa">FROZEN FITNESS <br> GOURMET</h1>
			</div>
			<div class="box_superior_direita">
				<div class="box_usuario">
					<img src="imagens/user.png">
					<p>Olá, Visitante!</p>
				</div>
				<div class="box_cadastro"><a href="cadastrar.php">Cadastre-se</a></div>
				<div class="box_login"><a href="login.php">Fazer Login</a></div>
			</div>
		</div>
		<div class="box_inferior">
			<div class="box_inferior_esquerda">
				<p>
				Para você que deseja perder peso rápido <br>
				ou ganhar aquela massa para o verão, <br>
				gosta de comer bem e não dispensa <br>
				um bom cardápio variado, conheça <br>
				nosso site!
				</p>
			</div>
			<div class="box_inferior_direita">
				<p class="promocao">Dietas a partir de:</p>
				<h1>R$ 18,99</h1>
				<p class="frete_gratis">Frete Grátis</p>

				<div><a href="home.php">Conheça agora</a></div>
			</div>

		</div>
	</div>
</body>
</html>
