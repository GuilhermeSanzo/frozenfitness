<?php

	// Incluindo as funções de CRUD desta página
	require_once('php/crud_fale_conosco.php');

	// Incluindo as funções de autenticação de nível de usuário
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
		AutenticaSAC($tipo_usuario_id);

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

	$nome_fale_conosco = null;
	$data_fale_conosco = null;
	$categoria_fale_conosco = null;
	$botao = "Pesquisar";

	$modo="?modo=novo";

	// Deixando o popup de mais detalhes desativado
	$ativado = "desativado";

	if(isset($_GET['modo'])){

		//obtendo valor do modo no CARREGAMENTO DA PAGINA
		$modo = $_GET['modo'];

		if($modo == 'excluir'){
			$_SESSION['fornecedor_id'] = $_GET['id'];
			Excluir($_SESSION['fornecedor_id']);
		}

		if($modo == 'detalhe') {
			$_SESSION['fornecedor_id'] = $_GET['id'];
			// Ativando o popup de mais detalhes;
			$ativado = "ativado";
		}

	}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<title>Cadastre-se - Frozen Fitness Gourmet</title>
	<link href="css/template.css" rel="stylesheet"/>
	<link href="css/cadastrar.css" rel="stylesheet"/>
	<script src="js/jquery.min.js"></script>
	<script src="js/template.js"></script>
	<link rel="icon" type="image/gif" href="img/logo.png">

	<!-- JavaScript 2.1 -->
	<script type="text/javascript" src="js/jquery-2.1.3.js"></script>

	<!-- jQuery do tipo data -->
	<link rel="stylesheet" href="js/jquery-ui/jquery-ui.css">
	<script src="js/jquery-ui/jquery-ui.js"></script>

	<!-- Estilização -->
	<link rel="stylesheet" type="text/css" href="css/template.css">
	<link rel="stylesheet" type="text/css" href="css/banner.css">

	<style media="screen">

		table {
			border-collapse: collapse;
		}

		.popup {
			width: 1026px;
	    height: 90%;
	    background-color: #fff;
	    margin: auto;
	    z-index: 100;
	    position: fixed;
	    top: 50%;
	    transform: translateY(-50%);
			border: 1px solid #000;
			box-shadow: 0 0 200px #000;
			display: none;
		}

		.popup_close {
			width: 50px;
			height: 50px;
			background: url('img/close-circle.png');
			background-repeat: no-repeat;
			background-position: center;
			background-size: cover;
			display: block;
			float: right;
			cursor: pointer;
			border-radius: 50%;
		}

		.detail {
			width: 50px;
			height: 50px;
			background: url('img/detail.png');
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			display: inline-block;
		}

		.remove {
			width: 50px;
			height: 50px;
			background: url('img/remove.png');
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			display: inline-block;
		}

		.ativado {
			display: block;
		}

		.desativado {
			display: none;
		}

		.popup h2 {
			text-align: center;
			margin-top: 1%;
			color: #70d06f;
		}

		.popup table {
			border-collapse: collapse;
			width: 96%;
			margin: auto;
		}

		.popup table tr {
		}

		.popup table tr td {
			padding-bottom: 10px;
		}

		.popup table tr .popup_titulo {
			width: 40%;
			text-align: right;
			font-weight: bold;
			position: relative;
			left: -50px;
		}

		.popup table tr .popup_resultado {
			width: 60%;
			text-align: justify;
		}

		.input_resultado {
			width: 69%;
		  height: 40px;
		  border: 1px solid #000;
		  border-radius: 50px;
		  font-size: 16px;
		  text-align: center;
		  padding: 0 4%;
		  outline: none;
			background: #fff;
		}

		.textarea_resultado {
			width: 69%;
		  height: 200px;
		  border: 1px solid #000;
		  border-radius: 20px;
		  font-size: 16px;
		  text-align: center;
		  padding: 0 4%;
		  outline: none;
			background: #fff;
			resize: none;
		}

		.textarea_resultado::-webkit-scrollbar {
			display: none;
		}

		.popup_excluir_link {
			text-align: center;
			text-decoration: none;
			color: #fff;
		}

		.popup_excluir {
			width: 60%;
			height: 40px;
		  border: 1px solid #000;
		  border-radius: 20px;
		  font-size: 16px;
		  text-align: center;
		  padding: 0 4%;
		  outline: none;
			background: #fb5555;
			resize: none;

		}

		.popup_excluir p {
			position: relative;
			top: 50%;
			transform: translateY(-50%);
		}

		.lido {
			background-color: #ffffff;
			font-weight: normal;
		}

		.nao_lido {
			background: #dedede;
    		font-weight: bold;
		}

		/* Pesquisa */
		.input-search {
			width: 100%;
			height: 32px;
			background-image: url(img/search.png);
			background-size: 25px;
			background-repeat: no-repeat;
			background-position: 99% 1px;
			position: relative;
			outline: none;
		}


	</style>

	<script type="text/javascript">
	// Fechando o quadro de detalhes pelo botão
	$(document).ready(function(){
		var container = $(".popup");

		$(".popup_close").click(function(){
			container.hide();
			window.location.href = "visualizacao_fale_conosco.php#ponto";
		});

		$(function(){
			$(".input-search").keyup(function(){
					//pega o css da tabela
					var tabela = $(this).attr('alt');
					if( $(this).val() != ""){
							$("."+tabela+" tbody>tr").hide();
							$("."+tabela+" td:contains-ci('" + $(this).val() + "')").parent("tr").show();
					} else{
							$("."+tabela+" tbody>tr").show();
					}
			});
		});
		$.extend($.expr[":"], {
			"contains-ci": function(elem, i, match, array) {
					return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
			}
		});

	});
	</script>

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
					<li class="menu_destacado_borda_direita">
						<a href="adm_sac.php" class="sac">
							<span class="image_menu_sac"></span>
							<p class="texto_menu">SAC</p>
						</a>
					</li>
				</ul>
			</div>
			<!-- Principal -->
			<div class="principal">

				<!-- Popup de mais detalhes -->
				<div class="popup <?php echo($ativado) ?>">
					<span class="popup_close"></span>
					<table>
						<h2>Informações Detalhadas</h2>
						<?php
							ListarDetalhado($_SESSION['fornecedor_id']);
						?>
					</table>
				</div>

				<!-- Cadastro de Tipos de Ingrediente -->
				<!-- <form name="form_tipo_ingrediente" method="post" enctype="multipart/form-data" action="cadastro_tipo_ingrediente.php<?php echo $modo ?>"> -->
					<div class="cadastro_ingrediente">
						<div class="cadastro_ingrediente_titulo">
							<h3>Pesquisa</h3>
						</div>
						<!-- Tabela inserida para bom posicionamento e estruturação dos itens -->
						<table>
							<tr>
								<td colspan="2"><input class="cadastro_input input-search" alt="lista-mensagens" type="text" name="nome" placeholder="Pesquisar: ID, Email, Titulo ou Categoria" value="<?php echo $nome_fale_conosco ?>"></td>
							</tr>
						</table>
					</div>
				<!-- </form> -->

				<!-- Visualização de Tipos de Ingrediente -->
				<div class="visualizacao_ingrediente" id="ponto">
					<div class="cadastro_ingrediente_titulo">
						<h3>Fale Conosco</h3>
					</div>
					<table class="lista-mensagens">
						<tr class="visualizacao_ingrediente_titulo_campo">
							<td>ID</td>
							<td>Email</td>
							<td>Titulo</td>
							<td>Categoria</td>
							<td>Opção</td>
						</tr>
						<?php
							Listar();
						?>

					</table>
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
