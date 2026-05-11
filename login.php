<?php

	require_once("php/crud_categoria.php");

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
		header("location:home.php");
	}

	if (isset($_POST["submit"])) {
		echo("<script>alert('Funciona!')</script>");
	}

 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<title>Home - Frozen Fitness Gourmet</title>
	
	<!-- Estilização Desktop -->
	<link href="css/template.css" rel="stylesheet"/>
	<link href="css/login.css" rel="stylesheet"/>

	<!-- Estilização Mobile -->
	<link href="css/mobile/template.css" rel="stylesheet"/>
	<link href="css/mobile/login.css" rel="stylesheet"/>

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>

	<!-- Template de Efeitos -->
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

	<!-- Script da imagem -->
	<script type="text/javascript" src="js/login.js"></script>
	<script type="text/javascript" src="js/upload_image.js"></script>
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

			<div style="clear:both">
			</div>
		</div>
	</div>

	<div class="esp_conteudo">
		<div class="conteudo">
			<div class="conteudo_transparente"></div>
			<div class="conteudo_visivel">
			<div class="box_login_corpo">
				<div class="box_caixa_login" id="caixa_da_esquerda">
					<div class="box_titulo_login" >
						Já é cadastrado?<br>
						Então faça login agora!
					</div>
					<form action="php/login.php" method="post">
						<div class="box_caixa_texto_login">
							<input type="email" name="txt_email" placeholder="e-mail" class="box_input_login">
						</div>
						<div class="box_caixa_texto_login">
							<input type="password" name="txt_senha" placeholder="senha" class="box_input_login">
						</div>
						<div class="box_caixa_texto_login" class="box_button_login">
							<input type="submit" name="btn_login" class="box_button_login">
						</div>
					</form>
				</div>
			</div>
			<div class="box_login_corpo">
				<div class="box_caixa_login" >
					<div class="box_titulo_login" >
						Ainda não é?<br>
						Então venha ser um dos nossos clientes!<br>

					</div>
					<a href="cadastrar.php" class="btn_cadastrar_link"><div class="btn_cadastrar" id="btn_cadastrar"> Cadastrar agora </div></a>
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
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
