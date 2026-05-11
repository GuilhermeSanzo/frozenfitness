<?php

	require_once('php/crud_parceiros.php');

	/* Verificando se a sessão já foi aberta */
  if(!isset($_SESSION)) {
    session_start();
  }

  if (!isset($_SESSION['carrinho'])) {
		$_SESSION['carrinho'] = array();
	}

	/* Contagem do carrinho */
	$contagem_prato = 0;
	$contagem_dieta = 0;

	if (!empty($_SESSION['carrinho']['prato'])) {
		$contagem_prato = count($_SESSION['carrinho']['prato']);
	}
	if (!empty($_SESSION['carrinho']['dieta'])) {
		$contagem_dieta = count($_SESSION['carrinho']['dieta']);
	}

	$contagem_carrinho = $contagem_prato + $contagem_dieta;

	$nome_usuario = "Olá visitante!";

	if (!empty($_SESSION["nome"])) {
		$nome_usuario = $_SESSION["nome"];

		/* Caso o usuário clicar no botão de sair */
		if (isset($_POST["user_exit"])) {
			session_destroy();
			header("REFRESH:0");
		}

		/* Caso o usuário clica no botão do cms */
		if (isset($_POST["user_cms"])) {
			header("location:cms/index.php");
		}

		/* Caso o usuario clicar no botão de dados pessoais */
		if (isset($_POST["user_config"])) {
			header("location:dados_usuario.php");
		}

	}

 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<title>Home - Frozen Fitness Gourmet</title>
	<link rel="icon" type="image/gif" href="imagens/logo.png">
	
	<!-- Estilização Desktop -->
	<link rel="stylesheet" type="text/css" href="css/template.css"/>
	<link rel="stylesheet" type="text/css" href="css/parceiros.css">

	<!-- Estilização Mobile -->
	<link rel="stylesheet" type="text/css" href="css/mobile/template.css"/>
	<link rel="stylesheet" type="text/css" href="css/mobile/parceiros.css">	

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>

	<!-- Template de Efeitos -->
	<script src="js/template.js"></script>
</head>
<body>
	<!-- Menu Superior -->
	<div class="esp_logo_menu_login">
		<div class="box_logo_menu_login">
			<div class="box_logo">

			</div>

			<div class="box_menu">

				<div class="box_menu_caixa">
					
					<div class="box_item_menu" id="menu_dropdown">
						<p>Menu</p>
					</div>

					<div class="box_item_menu">
						<a class="box_item_menu_estilo" href="home.php">Home</a>
					</div>
					<div class="box_item_menu">
						<a class="box_item_menu_estilo" href="promocoes.php">Promoções</a>
					</div>
					<div class="box_item_menu">
						<a class="box_item_menu_estilo" href="dicas_fitness.php">Dicas do Mundo Fitness</a>
					</div>
					<div class="box_item_menu">
						<a class="box_item_menu_estilo" href="parceiros.php">Parceiros</a>
					</div>
					<div class="box_item_menu">
						<a class="box_item_menu_estilo" href="sobre_nos.php">Sobre nós</a>
					</div>
					<div class="box_item_menu">
						<a class="box_item_menu_estilo" href="fale_conosco.php">Contato</a>
					</div>
				</div>

				<div class="box_action_menu_gradient">
					<div class="box_action_menu" id="barra_busca">

					</div>
				</div>
				<div class="box_action_menu_gradient">
					<a href="carrinho.php">
						<div class="box_action_menu" id="carrinho">
							<?php if (!empty($_SESSION['carrinho'])) { ?>
								<div class="box_action_menu_borda">
									<p>
										<?php echo($contagem_carrinho); ?>
									</p>
								</div>
							<?php } ?>
						</div>
					</a>
				</div>
				<div class="box_action_menu_gradient" id="box_open_menu">
					<div class="box_action_menu" id="open_menu"></div>
				</div>

				<div style="clear:both">
				</div>

			</div>

			<!-- Barra de Busca -->
			<div class="box_barra_busca">
				<form action="barra_busca.php" method="post">
					<div class="box_caixa_texto">
						<input type="text" name="txtBarraBusca" class="txtBarraBusca">
					</div>
					<div class="box_btn_pesquisar">
						<input type="submit" name="btnBarraBusca" class="btnBarraBusca" value="Pesquisar">
					</div>
					<div style="clear:both">
					</div>
				</form>
			</div>

			<div class="box_login">
				<div class="box_foto_ola">
					<?php if(empty($_SESSION['imagem'])) { ?>
						<div class="box_foto"></div>
					<?php } else { ?>
						<img class="img_box_foto" src="<?php echo $_SESSION['imagem'] ?>" alt="<?php echo $_SESSION['imagem'] ?>" />
					<?php } ?>
					<div class="ola">
						<?php echo($nome_usuario) ?>
					</div>
					<div style="clear:both">
					</div>
				</div>

				<!-- Verificando se a sessão está definida -->
				<?php
					if(isset($_SESSION["nome"])) {
				?>
				<div class="box_login_cadastrado">
					<form method="post">
						<div class="box_botoes">
							<input type="submit" name="user_exit" class="user_exit" value="">
							<input type="submit" name="user_config" class="user_config" value="">
							<!-- Verificando se o usuário é funcionário, para colocar o botão de atalho do CMS -->
							<?php
								if ($_SESSION["tipo_usuario_id"] != 1) {
							?>
							<input type="submit" name="user_cms" class="user_cms" value="">
							<?php
								}
							?>
						</div>
					</form>
				</div>

				<!-- Caso contrário... -->
				<?php

					} else {

				?>
				<div class="box_login_cadastrar">
					<form action="php/login.php" method="post">
						<div class="item_login">
							<input name="txt_email" type="text" class="texto_login" placeholder="E-mail">
						</div>
						<div class="item_login">
							<input name="txt_senha" type="password" class="texto_login" placeholder="Senha">
						</div>
						<div class="item_login">
							<input name="btn_login" type="submit" class="botao_login" id="fazer_login" value="Fazer Login">
						</div>
						<div class="item_login">
							<a href="cadastrar.php"><input class="botao_login" id="cadastrar" value="Cadastrar-se"></a>
						</div>
					</form>
				</div>
				<?php } ?>
			</div>
			<div style="clear:both">
			</div>
		</div>
	</div>

	<!-- Banner -->
	<div class="esp_banner">
		<div class="banner">
			<h1>Parceiros</h1>
		</div>
	</div>

	<!-- Conteúdo do site -->
	<div class="esp_conteudo">
		<!-- Faça seu conteúdo aqui -->
		<div class="conteudo">
			<!-- Parceiros -->
			<?php
			Listar();
			?>
	</div>


	<!-- Rodapé -->
	<div class="esp_rodape">
		<div class="box_localizacao_frase_cartoes">
			<div class="box_localizacao">
				<h3 class="localizacao_title">Localização</h3>
				<div class="localizacao_mapa"></div>
				<p class="localizacao_description">
					Rua tal, 123 - Bairro - Cidade - País - 00000-000
				</p>
			</div>
			<div class="box_frase">
				<div class="frase">
					Nossa empresa é referência <br>
					em produtos congelados,<br>
					dietas saudáveis e saborosas<br>
					de todos os tipos e culturas.<br>
					<br>
					Buscamos inovar sempre!
				</div>
			</div>
			<div class="box_cartoes">

			</div>
			<div style="clear:both">

			</div>
		</div>
	</div>
	<div style="clear:both">

	</div>

</body>
</html>
