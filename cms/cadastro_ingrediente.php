<?php

	// Incluindo as funções de CRUD desta página
	require_once('php/crud_ingrediente.php');

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
	$nome = "";
	$unidade = "Unidade";
	$tipo_ingrediente = "Tipo de ingrediente";
	$kcal_por_100g = "";


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

	//$value_unidade e $value_tipo_ingrediente->São as variáveis que vão preencher o value dos PRIMEIROS options dos select's de tipo_ingrediente e unidade
	//Isso foi feito para quando o modo for "editar", os values sejam preenchidos corretamentes.
	$value_unidade = "";
	$value_tipo_ingrediente = "";


	//Esse bloco de código só é executado quando o modo for EDITAR ou EXCLUIR
	//Isso foi feito para preencher os elementos do formulário e também para quando a ação excluir for acionada.
	if(isset($_GET['modo'])){

		//obtendo valor do modo no CARREGAMENTO DA PAGINA
		$modo = $_GET['modo'];
		if($modo == 'editar'){
			$modo = '?modo=atualizar';
			$_SESSION['ingrediente_id'] = $_GET['id'];
			$array = Buscar($_SESSION['ingrediente_id']);
			$nome = $array['nome'];
			$unidade = $array["unidade"];
			$value_unidade = $array["unidade_id"];
			$tipo_ingrediente = $array["tipo_ingrediente"];
			$value_tipo_ingrediente = $array["tipo_ingrediente_id"];;
			$kcal_por_100g = $array['kcal_por_100g'];
			$botao = 'Editar';
		}if($modo == 'excluir'){
			$_SESSION['ingrediente_id'] = $_GET['id'];
			Excluir($_SESSION['ingrediente_id']);
		}
	}


	//Esse bloco de código só é executado quando o botão SUBMIT for pressionado
	if(isset($_POST['submit'])){

		//Obtendo valor do modo na ação de clique do botão SUBMIT
		$modo = $_GET['modo'];

		//Obtendo os values dos elementos do formulário
		$nome = $_POST['nome'];
		$value_unidade = $_POST['unidade'];
		$value_tipo_ingrediente = $_POST['tipo_ingrediente'];
		$kcal_por_100g = $_POST['kcal_por_100g'];

		//upload do arquivo
		$pastaDestino = 'img/';//diretório
		$nome_foto = basename($_FILES['arquivo']['name']);//nome da imagem
		$caminho_imagem = $pastaDestino.$nome_foto;//caminho que será salvo no banco de dados
		$imagem = $_FILES['arquivo']['tmp_name'];// A imagem propriamente dita (Bitmap)

		//Se for um novo registro...
		if($modo == 'novo'){
			Inserir($nome,$value_unidade,$value_tipo_ingrediente,$kcal_por_100g,$caminho_imagem,$imagem);
		//Se for uma atualização de registro...
		}else if($modo == 'atualizar'){
			Editar($_SESSION['ingrediente_id'],$nome,$value_unidade,$value_tipo_ingrediente,$kcal_por_100g,$caminho_imagem,$imagem);

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
	<link rel="icon" type="image/gif" href="img/logo.png">

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
	<link rel="stylesheet" type="text/css" href="css/ingrediente.css">

	<!-- Script da imagem -->
	<script type="text/javascript" src="js/upload_image.js"></script>

	<script type="text/javascript" src="js/jquery_mask.js"></script>
	<script type="text/javascript" src="js/cadastro_ingrediente.js"> </script>

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

				<!-- Cadastro de Ingredientes -->
				<form name="form_ingrediente" method="post" enctype="multipart/form-data" action="cadastro_ingrediente.php<?php echo $modo ?>">
					<div class="cadastro_ingrediente">
						<div class="cadastro_ingrediente_titulo">
							<h3>Cadastro de Ingrediente</h3>
						</div>
						<!-- Tabela inserida para bom posicionamento e estruturação dos itens -->
						<table>
							<tr>
								<td>Nome: </td>
								<td><input required class="cadastro_input" type="text" name="nome" placeholder="Nome" value="<?php echo $nome ?>"></td>
							</tr>
							<tr>
								<td>Selecione uma imagem: </td>
								<td><input name="arquivo" type="file" id="filer_input" multiple="multiple" data-jfiler-limit="1"/></td>
							</tr>
							<tr>
								<td>Caloria (100g): </td>
								<td><input id="txtCaloria" required class="cadastro_input" type="text" name="kcal_por_100g" placeholder="Caloria (100g)" value="<?php echo $kcal_por_100g ?>"></td>
							</tr>
							<tr>
								<td>Tipo de Ingrediente: </td>
								<td>
									<select required class="selecao_cadastro" class="cadastro_input" type="text" name="tipo_ingrediente">
										"<option value='<?php echo $value_tipo_ingrediente ?>'><?php echo $tipo_ingrediente ?></option>"
										<?php
											$conexao = connect();
											$sql = "select * from tipo_ingrediente";
											$select = mysqli_query($conexao,$sql);
											while($array = mysqli_fetch_array($select)){
												echo "<option value=".$array['tipo_ingrediente_id'].">".$array['nome']."</option>";
											}
										?>
										<optgroup>

										</optgroup>
									</select>
								</td>
							</tr>
							<tr>
								<td>Unidade: </td>
								<td>
									<select required class="selecao_cadastro" class="cadastro_input" type="text" name="unidade">
										<option value="<?php echo $value_unidade ?>"><?php echo $unidade ?></option>
										<?php
											$conexao = connect();
											$sql = "select * from unidade";
											$select = mysqli_query($conexao,$sql);
											while($array = mysqli_fetch_array($select)){
												echo "<option value=".$array['unidade_id'].">".$array['nome']."</option>";
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td><input class="botoes_cadastro" type="submit" name="submit" value="<?php echo $botao ?>"></td>
								<td><input class="botoes_cadastro" type="reset" name="limpar" value="Limpar"></td>
							</tr>
						</table>




						<br><br>


					</div>
				</form>

				<!-- Visualização de Ingredientes -->
				<div class="visualizacao_ingrediente">
					<div class="cadastro_ingrediente_titulo">
						<h3>Visualização de Ingredientes</h3>
					</div>
					<table>
						<tr class="visualizacao_ingrediente_titulo_campo">
							<td>Nome</td>
							<td>Unidade</td>
							<td>Tipo</td>
							<td>Calorias (100g)</td>
							<td>Imagem</td>
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
