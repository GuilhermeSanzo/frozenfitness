<?php

	//Incluindo as funções de CRUD desta página
	require_once('php/crud_usuario.php');

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
		AutenticaGerenciadorUsuarios($tipo_usuario_id);

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
	$nome = null;
	$sobrenome = null;
	$email = null;
	$senha = null;

	$sexo = null;
	$value_sexo = 0;
	$txt_sexo = "Selecione o sexo";

	$data_nascimento = null;

	$tipo_usuario = null;
	$value_tipo_usuario = 0;
	$txt_tipo_usuario = "Selecione o tipo de usuário";

	$imagem = null;

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


	//Esse bloco de código só é executado quando o modo for EDITAR ou EXCLUIR
	//Isso foi feito para preencher os elementos do formulário e também para quando a ação excluir for acionada.
	if(isset($_GET['modo'])){

		//obtendo valor do modo no CARREGAMENTO DA PAGINA
		$modo = $_GET['modo'];
		if($modo == 'editar'){
			$modo = '?modo=atualizar';
			$_SESSION['usuario_id'] = $_GET['id'];


			$array = Buscar($_SESSION['usuario_id']);

			if ($array['sexo'] == 1) {
				$value_sexo = 1;
				$txt_sexo = 'Masculino';
				echo'
				<style>
					.mas{display:none};
				</style>
				';
			} else {
				$value_sexo = 0;
				$txt_sexo = 'Feminino';
				echo'
				<style>
					.fem{display:none};
				</style>
				';
			}

			$nome = $array['usuario'];
			$sobrenome = $array['sobrenome'];
			$email = $array['email'];
			$senha = $array['senha'];

			$sexo = $array['sexo'];

			$data_nascimento = $array['data_nascimento'];

			$tipo_usuario = $array["tipo_usuario_id"];
			$txt_tipo_usuario = $array["tipo_usuario"];
			$value_tipo_usuario = $array["tipo_usuario_id"];

			$botao = 'Editar';
		}if($modo == 'excluir'){
			$_SESSION['usuario_id'] = $_GET['id'];
			Excluir($_SESSION['usuario_id']);
		}
	}


	//Esse bloco de código só é executado quando o botão SUBMIT for pressionado
	if(isset($_POST['submit'])){

		//Obtendo valor do modo na ação de clique do botão SUBMIT
		$modo = $_GET['modo'];

		//Obtendo os values dos elementos do formulário

		$nome = $_POST['nome'];
		$sobrenome = $_POST['sobrenome'];
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$sexo = $_POST['sexo'];
		$data_nascimento = $_POST['data_nascimento'];
		$tipo_usuario = $_POST['tipo_usuario'];

		//upload do arquivo
		$pastaDestino = 'img/';//diretório
		$nome_foto = basename($_FILES['arquivo']['name']);//nome da imagem
		$caminho_imagem = $pastaDestino.$nome_foto;//caminho que será salvo no banco de dados
		$imagem = $_FILES['arquivo']['tmp_name'];// A imagem propriamente dita (Bitmap)

		//Se for um novo registro...
		if($modo == 'novo'){
			Inserir($nome, $sobrenome, $email, $senha, $sexo, $data_nascimento, $tipo_usuario, $caminho_imagem);
		//Se for uma atualização de registro...
		}else if($modo == 'atualizar'){
			Editar($_SESSION['usuario_id'], $nome, $sobrenome, $email, $senha, $sexo, $data_nascimento, $tipo_usuario, $caminho_imagem);
		//Se der algum problema...
		}else{
			echo 'cago';
		}
	}


	//Esse bloco de código só é executado quando o botão SUBMIT for pressionado
	if(isset($_POST['limpar'])){
		header("location:cms/cadastro_usuario.php");
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
	<title>Cadastro de Usuários</title>
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

	<style media="screen">



	.visualizacao_ingrediente table tr td {
		width: 0;
	}

	.detail {
		width: 50px;
		height: 50px;
		background: url('img/detail.png');
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center;
		display: inline-block;
		border-radius: 50%;
	}

	.remove {
		width: 50px;
		height: 50px;
		background: url('img/remove.png');
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center;
		display: inline-block;
		border-radius: 50%;
	}

	.edit {
		width: 50px;
		height: 50px;
		background: url('img/edit.png');
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center;
		display: inline-block;
		border-radius: 50%;
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
					<li class="menu_destacado">
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
				<form name="form_ingrediente" method="post" enctype="multipart/form-data" action="cadastro_usuario.php<?php echo $modo ?>">
					<div class="cadastro_ingrediente">
						<div class="cadastro_ingrediente_titulo" id="first_point">
							<h3>Cadastro de Usuários</h3>
						</div>
						<!-- Tabela inserida para bom posicionamento e estruturação dos itens -->
						<table>
							<tr>
								<td>Nome: </td>
								<td><input class="cadastro_input" type="text" name="nome" placeholder="Nome" value="<?php echo $nome ?>"></td>
							</tr>
							<tr>
								<td>Sobrenome: </td>
								<td><input class="cadastro_input" type="text" name="sobrenome" placeholder="Sobrenome" value="<?php echo $sobrenome ?>"></td>
							</tr>
							<tr>
								<td>Email: </td>
								<td><input class="cadastro_input" type="text" name="email" placeholder="Email" value="<?php echo $email ?>"></td>
							</tr>
							<tr>
								<td>Senha: </td>
								<td><input class="cadastro_input" type="password" name="senha" placeholder="Senha" value="<?php echo $senha ?>"></td>
							</tr>
							<tr>
								<td>Sexo: </td>
								<td>
									<select class="selecao_cadastro" class="cadastro_input" name="sexo">
										<!-- Verificando se o sexo está definido, para mostrar a mensagem de opção (ou não) -->
										<?php if ($sexo == null) { ?>
										<option selected="true" disabled value="<?php echo($value_sexo) ?>"><?php echo($txt_sexo) ?></option>
										<?php } else { ?>
										<option selected="true"  value="<?php echo($value_sexo) ?>"><?php echo($txt_sexo) ?></option>
										<?php } ?>
										<option value="1" class="mas">Masculino</option>
										<option value="0" class="fem">Feminino</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Data de Nascimento: </td>
								<td><input class="cadastro_input" type="text" name="data_nascimento" placeholder="Ex. 10/10/1990" value="<?php echo $data_nascimento ?>"></td>
							</tr>
							<tr>
								<td>Tipo de Usuário: </td>
								<td>
									<select class="selecao_cadastro" class="cadastro_input" name="tipo_usuario">
										<!-- Verificando se o tipo de usuário está definido, para mostrar a mensagem de opção (ou não) -->
										<?php if ($tipo_usuario == null) { ?>
										<option selected="true" disabled value="<?php echo($value_tipo_usuario) ?>"><?php echo($txt_tipo_usuario) ?></option>
										<?php } else { ?>
										<option selected="true"  value="<?php echo($value_tipo_usuario) ?>"><?php echo($txt_tipo_usuario) ?></option>
										<?php } ?>

										<?php
											$conexao = connect();
											$sql = "select * from tipo_usuario where tipo_usuario_id <> 1 and tipo_usuario_id <> ".$value_tipo_usuario." ";
											$select = mysqli_query($conexao,$sql);
											while($array = mysqli_fetch_array($select)){
												echo "<option value=".$array['tipo_usuario_id'].">".$array['nome']."</option>";
											}
										?>
										<optgroup>

										</optgroup>
									</select>
								</td>
							</tr>
							<tr>
								<td>Selecione uma imagem: </td>
								<td><input name="arquivo" type="file" id="filer_input" multiple="multiple" data-jfiler-limit="1"/></td>
							</tr>
							<!-- Botões de ação -->
							<tr>
								<td><input class="botoes_cadastro" type="submit" name="submit" value="<?php echo $botao ?>"></td>
								<td><input class="botoes_cadastro" type="reset" name="limpar" value="Limpar"></td>
							</tr>
						</table>

						<br><br>

					</div>
				</form>

				<!-- Visualização de Usuário -->
				<div class="visualizacao_ingrediente">
					<div class="cadastro_ingrediente_titulo" id="second_point">
						<h3>Visualização de Usuários</h3>
					</div>
					<table>
						<tr class="visualizacao_ingrediente_titulo_campo">

							<td>ID</td>
							<td>Nome</td>
							<td>Email</td>
							<td>Tipo de Usuário</td>
							<td>Opções</td>

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
