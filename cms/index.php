<?php

	require_once('php/autenticacao.php');

	/* Verificando se a sessão já foi aberta */
  if(!isset($_SESSION)) {
      session_start();
  }

	$nome_usuario = "Olá visitante!";

	/* Verificando se a variável de sessão está vazia */
	if (empty($_SESSION["nome"])) {
		echo "<script> alert('Você está tentando acessar uma página restrita!'); location = '../home.php' </script>";
	/* Se ela não estiver... */
	} else {
		$nome_usuario = $_SESSION["nome"];
		$tipo_usuario_id = $_SESSION["tipo_usuario_id"];

		AutenticaLinks($tipo_usuario_id);

		/* Acionando o botão de página web */
		if (isset($_POST["user_web"])) {
			header("location:../home.php");
		}
		/* Acionando o botão de configurações */
		if (isset($_POST["user_config"])) {
			header("location:../dados_usuario.php");
		}
		/* Acionando o botão de saída */
		if (isset($_POST["user_exit"])) {
			session_destroy();
			header("location:../home.php");
		}

	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Template do CMS</title>
	<link rel="stylesheet" type="text/css" href="css/template.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="icon" type="image/gif" href="img/logo.png">
	<meta charset="utf-8">

	<link rel="stylesheet" href="js/bootstrap/css/bootstrap2.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootbox/bootbox.min.js"></script>

	<style type="text/css">

		.principal {
			min-height: 850px;
		}

		.principal p, h1, img {
			text-align: center;
			margin: auto;

			/* habilita o flex nos filhos diretos */
			display: -ms-flex;
			display: -webkit-flex;
			display: flex;

			/* centraliza na horizontal */
		 	-ms-justify-content: center;
		 	-webkit-justify-content: center;
		 	justify-content: center;
		}

		.titulo_introducao {
			margin-top: 2%;
		}

		.imagem_introducao {
			width: 30%;
			margin-top: 2%;
		}

		.principal p {
			color: #696969;
			margin-top: 2%;
		}

		/* Caixa das mini seções */
		.mini_secao {
			width: 26%;
			height: 120px;
			border: 1px solid #000;
			border-radius: 20px;

			float: left;
			margin: auto;
			margin: 3% 0 0 5%;
		}

		.mini_secao a {
			width: 100%;
			height: 100%;
			text-decoration: none;

			/* habilita o flex nos filhos diretos */
			display: -ms-flex;
			display: -webkit-flex;
			display: flex;

			/* centraliza na vertical */
	    -ms-align-items: center;
	    -webkit-align-items: center;
			align-items: center;
		}

		.imagem_mini_secao {
			width: 35%;
			float: left;
			margin-left: 5%;
		}

		.titulo_mini_secao {
			width: 55%;
			float: right;
			position: relative;
			color: #5d5c5c;
		}
	</style>

</head>
<body>
	<!-- Corpo -->
	<div class="corpo">
		<!-- Cabeçalho -->
		<div class="cabecalho">
			<div class="centralizando_cabecalho">
				<div class="box_esquerda">
					<img class="imagem_logo" src="img/LOGO.png">
					<h1 class="titulo_logo">CMS - Frozen Fitness Gourmet</h1>
				</div>
				<div class="box_direita">
					<div class="box_usuario">
						<?php if(empty($_SESSION['imagem'])) { ?>
							<img class="user_image" src="img/usuario/img_user.png" alt="user">
						<?php } else { ?>
							<img class="user_image" src="../<?php echo $_SESSION['imagem'] ?>" alt="Profile Picture" />
						<?php } ?>
						<p class="user_name"><?php echo($nome_usuario)  ?></p>
					</div>
					<div class="box_botoes">
						<form method="post">
							<input type="submit" name="user_exit" class="user_exit" value="">
							<input type="submit" name="user_config" class="user_config" value="">
							<input type="submit" name="user_web" class="user_web" value="">
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Conteúdo -->
		<div class="conteudo">
			<!-- Menu -->
			<div class="menu">
				<ul>
					<li>
						<a href="adm_administrativo.php" class="administrativo">
							<span class="image_menu_prato"></span>
							<p class="texto_menu">Administrativo</p>
						</a>
					</li>
					<li>
						<a href="adm_marketing.php" class="marketing">
							<span class="image_menu_website"></span>
							<p class="texto_menu">Marketing</p>
						</a>
					</li>
					<li>
						<a href="adm_diretoria.php" class="diretoria">
							<span class="image_menu_frozen_fitness"></span>
							<p class="texto_menu">Diretoria</p>
						</a>
					</li>
					<li>
						<a href="adm_gerenciador_usuarios.php" class="gerenciador_usuarios">
							<span class="image_menu_usuario"></span>
							<p class="texto_menu">Gerenciador de Usuários</p>
						</a>
					</li>
					<li>
						<a href="adm_sac.php" class="sac">
							<span class="image_menu_sac"></span>
							<p class="texto_menu">SAC</p>
						</a>
					</li>
				</ul>
			</div>
			<!-- Principal -->
			<div class="principal">
				<!-- Seção -->
				<h1 class="titulo_introducao">Bem-vindo: <?php echo $nome_usuario ?></h1>
				<p class="texto_introducao">ao CMS da Frozen Fitness Gourmet</p>
				<img class="imagem_introducao" src="img/logo.png" alt="Logo">
				<p class="texto_introducao">Abaixo segue a lista das seções onde você possui acesso:</p>

				<!-- Mini Seção -->
				<?php

					if ($tipo_usuario_id == 2 || $tipo_usuario_id == 3) {

				?>
				<div class="mini_secao">
					<a href="adm_administrativo.php">
						<img class="imagem_mini_secao" src="img/plate.png" alt="Prato">
						<h5 class="titulo_mini_secao">Administrativo</h5>
					</a>
				</div>
				<?php

					} if ($tipo_usuario_id == 2 || $tipo_usuario_id == 4) {

				?>
				<!-- Mini Seção -->
				<div class="mini_secao">
					<a href="adm_marketing.php">
						<img class="imagem_mini_secao" src="img/website.png" alt="Prato">
						<h5 class="titulo_mini_secao">Marketing</h5>
					</a>
				</div>
				<?php

					} if ($tipo_usuario_id == 2 || $tipo_usuario_id == 5) {

				?>
				<!-- Mini Seção -->
				<div class="mini_secao">
					<a href="adm_diretoria.php">
						<img class="imagem_mini_secao" src="img/logo_black_white.png" alt="Prato">
						<h5 class="titulo_mini_secao">Diretoria</h5>
					</a>
				</div>

				<?php

					} if ($tipo_usuario_id == 2 || $tipo_usuario_id == 6) {

				?>
				<!-- Mini Seção -->
				<div class="mini_secao">
					<a href="adm_gerenciador_usuarios.php">
						<img class="imagem_mini_secao" src="img/usuario.png" alt="Prato">
						<h5 class="titulo_mini_secao">Gerenciador de Usuários</h5>
					</a>
				</div>
				<?php

					} if ($tipo_usuario_id == 2 || $tipo_usuario_id == 7 || $tipo_usuario_id == 5) {

				?>
				<!-- Mini Seção -->
				<div class="mini_secao">
					<a href="adm_sac.php">
						<img class="imagem_mini_secao" src="img/fale_conosco.png" alt="Prato">
						<h5 class="titulo_mini_secao">SAC</h5>
					</a>
				</div>
				<?php

					}

				?>
			</div>
		</div>
		<!-- Rodapé -->
		<div class="rodape">
			<div class="centralizando_rodape"></div>
		</div>
	</div>

</body>
</html>
