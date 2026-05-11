<?php

	require_once('cms/php/geral.php');

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

		$nome = $_POST['txt_nome'];
		$sobre_nome = $_POST['txt_sobre_nome'];
		$email = $_POST['txt_email'];
		$senha = $_POST['txt_senha'];
		$data_nascimento = $_POST['txt_data_nascimento'];
		$cpf = $_POST['txt_cpf'];
		$telefone = $_POST['txt_telefone'];
		$peso = $_POST['txt_peso'];
		$altura = $_POST['txt_altura'];
		$tipo_dieta_id = $_POST['txt_tipo_dieta_id'];

		//Se for um novo registro...
		if($modo == 'novo'){
			Inserir($nome, $sobre_nome, $email, $senha, $data_nascimento, $cpf, $telefone, $peso, $altura, $tipo_dieta_id);
			echo('<script>alert("Primeira parte, funcionando!")</script>');
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
	<link href="css/template.css" rel="stylesheet"/>
	<link href="css/cadastrar.css" rel="stylesheet"/>
	<script src="js/jquery.min.js"></script>
	<script src="js/template.js"></script>
	<link rel="icon" type="image/gif" href="imagens/logo.png">
</head>
<body>
	<!-- Menu Superior -->
	<div class="esp_logo_menu_login">
		<div class="box_logo_menu_login">
			<div class="box_logo">

			</div>
			<a class="box_item_menu_estilo" href="faca_sua_dieta.php">
				<div class="box_faca_sua_dieta">
					<div class="faca_sua_dieta">
						Faça já<br>
						a sua Dieta
					</div>
					<div class="box_icon_mais">

					</div>
				</div>
			</a>
			<div class="box_menu">

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

				<div class="box_action_menu_gradient">
					<div class="box_action_menu" id="barra_busca">

					</div>
				</div>
				<div class="box_action_menu_gradient">
					<div class="box_action_menu" id="carrinho">

					</div>
				</div>

				<div style="clear:both">
				</div>

			</div>
			<div class="box_login">
				<div class="box_foto_ola">
					<div class="box_foto">

					</div>
					<div class="ola">
						Olá!, Visitante
					</div>
					<div style="clear:both">
					</div>
				</div>
				<div class="box_login_cadastrar">
					<div class="item_login">
						<input type="text" class="texto_login" placeholder="E-mail">
					</div>
					<div class="item_login">
						<input type="password" class="texto_login" placeholder="Senha">
					</div>
					<div class="item_login">
						<input type="submit" class="botao_login" id="fazer_login" value="Fazer Login">
					</div>
					<div class="item_login">
						<a href="cadastrar.php"><input type="submit" class="botao_login" id="cadastrar" value="Cadastrar-se"></a>
					</div>
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
						<div class="title_caixa_texto">Nome</div>
						<div class="input_caixa_texto">
							<input name="txt_nome" type="text" class="input_text" placeholder="Insira seu nome">
						</div>
					</div>
					<div class="caixa_texto">
						<div class="title_caixa_texto">E-mail</div>
						<div class="input_caixa_texto">
							<input name="txt_email" type="text" class="input_text" placeholder="Insira seu e-mail">
						</div>
					</div>
	        <div class="caixa_texto">
						<div class="title_caixa_texto">Senha</div>
						<div class="input_caixa_texto">
							<input name="txt_senha" type="text" class="input_text" placeholder="Informe a senha desejada">
						</div>
					</div>
	        <div class="caixa_texto">
						<div class="title_caixa_texto">Confirmar Senha</div>
						<div class="input_caixa_texto">
							<input name="txt_senha" type="text" class="input_text" placeholder="Confirme a senha inserida">
						</div>
					</div>
					<div class="caixa_spinner">
						<label>
						    <select name="txt_sexo">
						        <option selected> Sexo </option>
						        <option>------------------------</option>
						        <option>Masculino</option>
						        <option>Feminino</option>
						    </select>
						</label>
					</div>
	        <div class="caixa_texto">
						<div class="title_caixa_texto">Data de Nascimento</div>
						<div class="input_caixa_texto">
							<input name="txt_data_nascimento" type="text" class="input_text" placeholder="dd/mm/aaaa">
						</div>
					</div>
					<div class="caixa_texto">
					<div class="title_caixa_texto">CPF</div>
						<div class="input_caixa_texto">
							<input name="txt_cpf" type="text" class="input_text" placeholder="562.238.216-52">
						</div>
					</div>
					<div class="title_caixa_texto">Telefone</div>
						<div class="input_caixa_texto">
							<input name="txt_telefone" type="text" class="input_text" placeholder="(11)4002-8922">
						</div>
					</div>
					<div class="caixa_texto">
						<div class="title_caixa_texto">Peso</div>
						<div class="input_caixa_texto">
							<input name="txt_peso" type="text" class="input_text" placeholder="Exemplo: 60,8">
						</div>
					</div>
					<div class="caixa_texto">
						<div class="title_caixa_texto">Altura</div>
						<div class="input_caixa_texto">
							<input name="txt_altura" type="text" class="input_text" placeholder="Exemplo: 2,5">
						</div>
					</div>
					<div class="caixa_spinner">
						<label>
						    <select name="txt_tipo_dieta_id">
						        <option selected> Objetivo </option>
						        <option>------------------------</option>
						        <option value="1">Ganho de Massa Magra</option>
						        <option value="2">Ganho de Peso</option>
                    <option value="3">Perca de Peso</option>
                    <option value="4">Definição Muscular</option>
						    </select>
						</label>
					</div>
	        <div class="caixa_texto">
						<div class="input_caixa_texto">
							<input type="submit" class="form_submit" value="Cadastrar">
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
