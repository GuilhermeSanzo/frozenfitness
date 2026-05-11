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

	/* Verificando se o usuário é funcionário da empresa */
	AutenticaLinks($tipo_usuario_id);
	AutenticaDiretoria($tipo_usuario_id);

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

//Obtendo dados estatísticos
require_once('json/estatisticas.php');
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Template do CMS</title>
	<link rel="stylesheet" type="text/css" href="css/template.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/adm_diretoria.css?456">
	<script type="text/javascript" src="js/bootbox/bootbox.min.js"></script>

	<script src="js/jquery.min.js"></script>
	<script src="js/adm_diretoria.js"></script>

	<link rel="icon" type="image/gif" href="img/logo.png">
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
					<li class="menu_destacado">
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
				<div class="box_botoes_diretoria">
					<div class="botao_diretoria destaque" id="btn_estatisticas">
						<div class="icon_botao_diretoria" id="icon_estatisticas">

						</div>
						<div class="texto_botao_diretoria" id="texto_estatisticas">
							Estatísticas
						</div>
					</div>
					<div class="botao_diretoria" id="btn_aprovacoes">
						<div class="icon_botao_diretoria" id="icon_aprovacoes">

						</div>
						<div class="texto_botao_diretoria" id="texto_aprovacoes">
							Aprovações
						</div>
					</div>

				</div>
				<div class="box_conteudo_diretoria" id="estatisticas">
					<div class="wrapper">
					  <h1>TOP 5 - Produtos Vendidos</h1>
					  <p>Neste gráfico é possível visualizar quais são os pratos mais comprados pelos clientes</p>
					  <div id="chart"></div>
					</div>

					<div class="wrapper">
					  <h1>TOP 5 - Produtos Visualizados</h1>
					  <p>Neste gráfico é possível visualizar quais são os pratos mais vistos pelos clientes</p>
					  <div id="chart2"></div>
					</div>
				</div>

				<div class="box_conteudo_diretoria" id="aprovacoes">

					<div class="box_para_aprovar">
						<div class="box_titulo_itens">Itens para aprovar</div>
						<div class="box_itens" id="itens_para_aprovar">

						</div>
						<div style="clear:both"></div>
					</div>
					<div class="box_aprovado">
						<div class="box_titulo_itens">Itens aprovados</div>
						<div class="box_itens" id="itens_aprovados">

						</div>
					</div>
					<div style="clear:both"></div>
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
		<!-- Rodapé -->
		<div class="rodape">
			<div class="centralizando_rodape"></div>
		</div>
	</div>

</body>
</html>
