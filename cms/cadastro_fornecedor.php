<?php

	// Incluindo as funções de CRUD desta página
	require_once('php/crud_fornecedor.php');

	// Incluindo as funções de autenticação de usuário
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
		AutenticaAdministrativo($tipo_usuario_id);

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

	//Váriáveis da Entidade:
	//São as variáveis que serão usadas para inserir as informações que o usuário informa na tela
	//Essas variáveis também serão utilizadas para recuperar os valores e preencher os InputText's e Select's na hora de editar um registro.

	$razao_social_fornecedor = "";
	$nome_fantasia_fornecedor = "";
	$cnpj_fornecedor = "";
	$numero_fornecedor = "";
	$estado_fornecedor = "";
	$cidade_fornecedor = "";
	$bairro_fornecedor = "";
	$logradouro_fornecedor = "";
	$numero_fornecedor = "";
	$cep_fornecedor = "";


	//Variáveis de funcionalidade:
	//$modo->É a variável que irá controlar as operações do CRUD.
	//ela pode ser:
	//novo - Faz o insert de um novo registro
	//excluir - Faz o delete de um registro
	//editar - Faz a busca de um registro e preenche os Input's e select's
	//atualizar - Faz o update propriamente dito no banco de dados
	$modo="?modo=novo";

	//$botao->É a variavel que vai preencher o botão  com "Inserir" ou "Editar"
	$botao= "Inserir";

	//$value_cidade e $value_estado->São as variáveis que vão preencher o value dos PRIMEIROS options dos select's de cidade e estado
	//Isso foi feito para quando o modo for "editar", os values sejam preenchidos corretamentes.
	$value_cidade = "";
	$value_estado = "";


	//Esse bloco de código só é executado quando o modo for EDITAR ou EXCLUIR
	//Isso foi feito para preencher os elementos do formulário e também para quando a ação excluir for acionada.
	if(isset($_GET['modo'])){

		//obtendo valor do modo no CARREGAMENTO DA PAGINA
		$modo = $_GET['modo'];
		if($modo == 'editar'){
			$modo = '?modo=atualizar';
			$_SESSION['fornecedor_id'] = $_GET['id'];
			$array = Buscar($_SESSION['fornecedor_id']);
			$razao_social_fornecedor = $array['razao_social'];
			$nome_fantasia_fornecedor = $array['nome_fantasia'];
			$cnpj_fornecedor = $array['cnpj'];
			$numero_fornecedor = $array['numero'];
			$estado_fornecedor = $array['estado'];
			$cidade_fornecedor = $array['cidade'];
			$bairro_fornecedor = $array['bairro'];
			$logradouro_fornecedor = $array['nome_rua'];
			$numero_fornecedor = $array['numero'];
			$cep_fornecedor = $array['cep'];
			$botao = 'Editar';
		}if($modo == 'excluir'){
			$_SESSION['fornecedor_id'] = $_GET['id'];
			Excluir($_SESSION['fornecedor_id']);
		}
	}


	//Esse bloco de código só é executado quando o botão SUBMIT for pressionado
	if(isset($_POST['submit'])){

		//Obtendo valor do modo na ação de clique do botão SUBMIT
		$modo = $_GET['modo'];

		//Obtendo os values dos elementos do formulário
		$razao_social = $_POST['razao_social'];
		$nome_fantasia = $_POST['nome_fantasia'];
		$cnpj = $_POST['cnpj'];
		$numero = $_POST['numero'];
		$estado = $_POST['estado'];
		$cidade = $_POST['cidade'];
		$bairro = $_POST['bairro'];
		$logradouro = $_POST['logradouro'];
		$cep = $_POST['cep'];

		//Se for um novo registro...
		if($modo == 'novo'){
			Inserir($razao_social,$nome_fantasia,$cnpj,$logradouro,$numero,$bairro,$cep,$cidade,$estado);
		//Se for uma atualização de registro...
		}else if($modo == 'atualizar'){
			Editar($_SESSION['fornecedor_id'],$razao_social,$nome_fantasia,$cnpj,$logradouro,$numero,$bairro,$cep,$cidade,$estado);
		//Se der algum problema...
		}else{
			echo 'cago';
		}
	}


?>


<!-- Informações importantes para ressaltar sobre o código HTML:

	- A variável $modo é utilizada no Action do formulário.

-->

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
	<link rel="icon" type="image/gif" href="imagens/logo.png">

	<!-- JavaScript 2.1 -->
	<script type="text/javascript" src="js/jquery-2.1.3.js"></script>

	<!-- Caixa do Upload -->
	<link href="js/jQuery.filer-1.0.5/css/jquery.filer.css" type="text/css" rel="stylesheet" />
	<link href="js/jQuery.filer-1.0.5/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
	<script src="js/jQuery.filer-1.0.5/js/jquery.filer.min.js"></script>

	<!-- jQuery do tipo data -->
	<link rel="stylesheet" href="js/jquery-ui/jquery-ui.css">
	<script src="js/jquery-ui/jquery-ui.js"></script>

	<!-- Estilização -->
	<link rel="stylesheet" type="text/css" href="css/template.css">
	<link rel="stylesheet" type="text/css" href="css/fornecedor.css">

	<script src="js/jquery.mask.min.js"></script>
	<script src="js/cadastro_fornecedor.js"></script>

	<!-- Script da imagem -->
	<script type="text/javascript" src="js/upload_image.js"></script>
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
          <li class="menu_destacado_borda_esquerda">
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

				<!-- Cadastro de Fornecedores -->
				<form name="form_fornecedor" method="post" enctype="multipart/form-data" action="cadastro_fornecedor.php<?php echo $modo ?>">
					<div class="cadastro_ingrediente">
						<div class="cadastro_ingrediente_titulo">
							<h3>Cadastro de Fornecedores</h3>
						</div>
						<!-- Tabela inserida para bom posicionamento e estruturação dos itens -->
						<table>
							<tr>
								<td>Razão Social: </td>
								<td><input required class="cadastro_input" type="text" name="razao_social" placeholder="Razão Social" value="<?php echo $razao_social_fornecedor ?>"></td>
							</tr>
							<tr>
								<td>Nome Fantasia: </td>
								<td><input required class="cadastro_input" type="text" name="nome_fantasia" placeholder="Nome Fantasia" value="<?php echo $nome_fantasia_fornecedor ?>"></td>
							</tr>
							<tr>
								<td>CNPJ: </td>
								<td><input required id="txtCnpj" class="cadastro_input" type="text" name="cnpj" placeholder="CNPJ" value="<?php echo $cnpj_fornecedor ?>"></td>
							</tr>
							<tr>
								<td>Rua: </td>
								<td><input required class="cadastro_input" type="text" name="logradouro" placeholder="Nome da Rua" value="<?php echo $logradouro_fornecedor ?>"></td>
							</tr>
							<tr>
								<td>Número: </td>
								<td><input required class="cadastro_input" type="text" name="numero" placeholder="Número" value="<?php echo $numero_fornecedor ?>"></td>
							</tr>
							<tr>
								<td>Bairro: </td>
								<td><input required class="cadastro_input" type="text" name="bairro" placeholder="Bairro" value="<?php echo $bairro_fornecedor ?>"></td>
							</tr>
							<tr>
								<td>CEP: </td>
								<td><input required id="txtCep" class="cadastro_input" type="text" name="cep" placeholder="CEP" value="<?php echo $cep_fornecedor ?>"></td>
							</tr>
							<tr>
								<td>Cidade: </td>
								<td><input required class="cadastro_input" type="text" name="cidade" placeholder="Cidade" value="<?php echo $cidade_fornecedor ?>"></td>
							</tr>
							<tr>
								<td>Estado: </td>
								<td><input required class="cadastro_input" type="text" name="estado" placeholder="Estado" value="<?php echo $estado_fornecedor ?>"></td>
							</tr>
							<tr>
								<td><input class="botoes_cadastro" type="submit" name="submit" value="<?php echo $botao ?>"></td>
								<td><input class="botoes_cadastro" type="reset" name="limpar" value="Limpar"></td>
							</tr>
						</table>
					</div>
				</form>

				<!-- Visualização de Ingredientes -->
				<div class="visualizacao_ingrediente">
					<div class="cadastro_ingrediente_titulo">
						<h3>Visualização de Fornecedores</h3>
					</div>
					<table>
						<tr class="visualizacao_ingrediente_titulo_campo">
							<td>ID</td>
							<td>Razão Social</td>
							<td>Nome Fantasia</td>
							<td>CNPJ</td>
							<td>Rua</td>
							<td>Número</td>
							<td>CEP</td>
							<td>Cidade</td>
							<td>Estado</td>
							<td>Bairro</td>
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
