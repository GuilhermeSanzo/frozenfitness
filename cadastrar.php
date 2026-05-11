<?php

	require_once('php/crud_usuario.php');

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

	// Verificando se o usuário está logado
	$nome_usuario = "Olá visitante!";

	if (!empty($_SESSION["nome"])) {
		$nome_usuario = $_SESSION["nome"];

		if (isset($_POST["user_exit"])) {
			session_destroy();
			header("REFRESH:0");
		}

	}

	$nome = null;
	$email = null;
	$senha = null;
	$data_nascimento = null;
	$cpf = null;
	$telefone = null;
	$peso = null;
	$altura = null;
	$tipo_dieta_id = null;

	$modo="?modo=novo";

	//$botao->É a variavel que vai preencher o botão  com "Inserir" ou "Editar"
	$botao= "Inserir";

	if(isset($_POST['submit'])){

		//Obtendo valor do modo na ação de clique do botão SUBMIT
		$modo = $_GET['modo'];

		//Obtendo os values dos elementos do formulário

		$nome = ucfirst(strtolower($_POST['txt_nome']));
		$sobre_nome = ucfirst(strtolower($_POST['txt_sobre_nome']));

		$email = $_POST['txt_email'];
		$senha = $_POST['txt_senha'];
		$sexo = $_POST['txt_sexo'];
		
		$data_nascimento = $_POST['txt_data_nascimento'];

		$dia_nascimento = substr($data_nascimento, 0, 2);
		$mes_nascimento = substr($data_nascimento, 3, 2);
		$ano_nascimento = substr($data_nascimento, 6, 4);

		$data_nascimento = $ano_nascimento . '-' . $mes_nascimento . '-' . $dia_nascimento;

		$cpf = $_POST['txt_cpf'];
		$telefone = $_POST['txt_telefone'];
		
		$peso = str_replace(',', '.', $_POST['txt_peso']);
		$altura = str_replace(',', '.', $_POST['txt_altura']);

		$tipo_dieta_id = $_POST['txt_tipo_dieta_id'];

		//Se for um novo registro...
		if($modo == 'novo'){
			Inserir($nome, $sobre_nome, $email, $senha, $sexo, $data_nascimento, $cpf, $telefone, $peso, $altura, $tipo_dieta_id);
		//Se der algum problema...
		}else{
			echo 'cago';
		}
	}



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<title>Cadastre-se - Frozen Fitness Gourmet</title>
	<link rel="icon" type="image/gif" href="imagens/logo.png">
	
	<!-- Estilização Desktop -->
	<link href="css/template.css" rel="stylesheet"/>
	<link href="css/cadastrar.css" rel="stylesheet"/>

	<!-- Estilização Mobile -->
	<link href="css/mobile/template.css" rel="stylesheet"/>
	<link href="css/mobile/cadastrar.css" rel="stylesheet"/>

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>

	<!-- Template de Efeitos -->
	<script src="js/template.js"></script>

	<link rel="stylesheet" href="cms/js/bootstrap/css/bootstrap2.css">
	<!-- <script type="text/javascript" src="cms/js/jquery.min.js"></script> -->
	<script type="text/javascript" src="cms/js/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="cms/js/bootbox/bootbox.min.js"></script>

	<!-- Mascara -->
	<script type="text/javascript" src="cms/js/jquery_mask.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {

			$("#data_nascimento").mask("00/00/0000");
			$("#cpf").mask("000.000.000-00");
			$("#telefone").mask("(00)0000-00000");

			// Verificando se a url contém modo=novo
			if(window.location.href.indexOf("modo=novo") > -1) {
				bootbox.alert({
					message: 'Cadastrado com sucesso, por favor faça login!',
					callback: function(){
							$(location).attr('href','login.php');
					}
				});
			}
		});
	</script>


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
			</div>
			<div style="clear:both">
			</div>
		</div>
	</div>

	<!-- Banner -->
	<div class="esp_banner">
		<div class="banner">
			<h1>Cadastre-se agora</h1>
		</div>
	</div>

	<!-- Conteúdo do site -->
	<div class="esp_conteudo">
		<div class="conteudo">
			<form name="form_cadastro_usuario" method="post" action="cadastrar.php<?php echo $modo ?>">
				<div class="box_form_fale_conosco">
					<div class="caixa_texto">
						<div class="box_nome" >
							<div class="title_caixa_texto">Nome</div>
							<div class="input_caixa_texto">
								<input name="txt_nome" type="text" class="input_text" placeholder="Insira seu nome" required>
							</div>
						</div>
						<div class="box_sobre_nome" >
							<div class="title_caixa_texto">Sobrenome</div>
							<div class="input_caixa_texto">
								<input name="txt_sobre_nome" type="text" class="input_text" placeholder="Insira seu sobre" required>
							</div>
						</div>
						<div style="clear:both">

						</div>
					</div>

					<div class="caixa_texto">
						<div class="title_caixa_texto">E-mail</div>
						<div class="input_caixa_texto">
							<input name="txt_email" type="email" class="input_text" placeholder="Insira seu e-mail" required>
						</div>
					</div>
	        		<div class="caixa_texto">
						<div class="title_caixa_texto">Senha</div>
						<div class="input_caixa_texto">
							<input name="txt_senha" type="password" class="input_text" placeholder="Informe a senha desejada" required>
						</div>
					</div>
	        		<div class="caixa_texto">
						<div class="title_caixa_texto">Confirmar Senha</div>
						<div class="input_caixa_texto">
							<input name="txt_senha" type="password" class="input_text" placeholder="Confirme a senha inserida" required>
						</div>
					</div>
					<div class="caixa_spinner">
						<label>
						    <select name="txt_sexo" required>
						        <option selected disabled value=""> Sexo </option>
						        <option value="1">Masculino</option>
						        <option value="0">Feminino</option>
						    </select>
						</label>
					</div>
	        		<div class="caixa_texto">
						<div class="title_caixa_texto">Data de Nascimento</div>
						<div class="input_caixa_texto">
							<input name="txt_data_nascimento" id="data_nascimento" type="text" class="input_text" placeholder="dd/mm/aaaa" required>
						</div>
					</div>
					<div class="caixa_texto">
					<div class="title_caixa_texto">CPF</div>
						<div class="input_caixa_texto">
							<input name="txt_cpf" type="text" id="cpf" class="input_text" placeholder="562.238.216-52" required>
						</div>
					</div>
					<div class="caixa_texto">
					<div class="title_caixa_texto">Telefone</div>
						<div class="input_caixa_texto">
							<input name="txt_telefone" type="text" id="telefone" class="input_text" placeholder="(11)4002-8922" required>
						</div>
					</div>
					<div class="caixa_texto">
					<div class="title_caixa_texto">Peso</div>
						<div class="input_caixa_texto">
							<input name="txt_peso" type="text" class="input_text" placeholder="Exemplo: 60,8" required>
						</div>
					</div>
					<div class="caixa_texto">
						<div class="title_caixa_texto">Altura</div>
						<div class="input_caixa_texto">
							<input name="txt_altura" type="text" class="input_text" placeholder="Exemplo: 2,5" required>
						</div>
					</div>
					<div class="caixa_spinner">
						<label>
						    <select name="txt_tipo_dieta_id" required>
						        <option disabled selected value=""> Objetivo </option>
						        <option value="1">Ganho de Massa Magra</option>
						        <option value="2">Ganho de Peso</option>
                   				<option value="3">Perca de Peso</option>
                    
						    </select>
						</label>
					</div>
	        		<div class="caixa_texto">
						<div class="input_caixa_texto">
							<input name="submit" type="submit" class="form_submit" value="Cadastrar">
						</div>
					</div>
				</div>
			</form>
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
