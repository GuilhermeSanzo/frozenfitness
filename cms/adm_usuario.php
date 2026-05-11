<?php

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

		/* Verificando se o usuário é funcionário da empresa */
		if ($tipo_usuario_id != 2) {
			echo "<script> alert('".ucfirst(strtolower($nome_usuario)).", você está tentando acessar uma página restrita!'); location = '../home.php' </script>";
		} else {
			/* Acionando o botão de página web */
			if (isset($_POST["user_web"])) {
				header("location:../home.php");
			}
			/* Acionando o botão de configurações */
			if (isset($_POST["user_config"])) {
				// Code...
			}
			/* Acionando o botão de saída */
			if (isset($_POST["user_exit"])) {
				session_destroy();
				header("location:../home.php");
			}
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
						<img class="user_image" src="img/img_user.png" alt="user">
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
						<a href="adm_prato.php">
							<span class="image_menu_prato"></span>
							<p class="texto_menu">Adm. de Prato</p>
						</a>
					</li>
					<li>
						<a href="adm_website.php">
							<span class="image_menu_website"></span>
							<p class="texto_menu">Adm. do Website</p>
						</a>
					</li>
					<li>
						<a href="adm_frozen_fitness.php">
							<span class="image_menu_frozen_fitness"></span>
							<p class="texto_menu">Adm. da Frozen Fitness</p>
						</a>
					</li>
					<li class="menu_destacado_borda_direita">
						<a href="adm_sac.php">
							<span class="image_menu_sac"></span>
							<p class="texto_menu">SAC</p>
						</a>
					</li>
				</ul>
			</div>
			<!-- Principal -->
			<div class="principal">
				<!-- Seção -->
				<div class="box_secao">
					<a href="cadastro_usuario.php">
						<div class="box_secao_primaria">
							<img src="img/usuario.png" alt="imagem">
							<h3>Usuário</h3>
						</div>
						<div class="box_secao_secundaria">
							<ul>
								<li>Visualizar de  Usuário</li>
								<li>Inserir de Usuário</li>
								<li>Editar de Usuário</li>
								<li>Cadastrar de Usuário</li>
							</ul>
						</div>
					</a>
				</div>
				<!-- Seção -->
				<div class="box_secao">
					<a href="cadastro_tipo_usuario.php">
						<div class="box_secao_primaria">
							<img src="img/tipo_usuario.png" alt="imagem">
							<h3>Tipo de Usuário</h3>
						</div>
						<div class="box_secao_secundaria">
							<ul>
								<li>Visualizar em Tipo de Usuário</li>
								<li>Inserir em Tipo de Usuário</li>
								<li>Editar em Tipo de Usuário</li>
								<li>Cadastrar em Tipo de Usuário</li>
							</ul>
						</div>
					</a>
				</div>
			</div>
		</div>
		<!-- Rodapé -->
		<div class="rodape">
			<div class="centralizando_rodape"></div>
		</div>
	</div>

</body>
</html>
