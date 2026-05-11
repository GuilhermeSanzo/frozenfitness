<?php

	require_once("php/crud_dados_usuario.php");

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

		/* Caso o usuário clicar no botão do cms */
		if (isset($_POST["user_cms"])) {
			header("location:cms/index.php");
		}

		/* Caso o usuario clicar no botão de dados pessoais */
		if (isset($_POST["user_config"])) {
			header("location:dados_usuario.php");
		}

		// Variáveis
		$nome = null;
		$sobrenome = null;
		$sexo = null;
		$data_nascimento = null;
		$cpf = null;
		$telefone = null;
		$peso = null;
		$altura = null;
		$tipo_dieta_id = null;

		$array = Buscar($_SESSION['usuario_id']);

		$nome = $array['nome'];
		$sobrenome = $array['sobrenome'];
		$sexo = $array['sexo'];

		$data_nascimento = $array['data_nascimento'];

		$dia_nascimento = substr($data_nascimento, 8, 2);
		$mes_nascimento = substr($data_nascimento, 5, 2);
		$ano_nascimento = substr($data_nascimento, 0, 4);

		$data_nascimento = $dia_nascimento . '/' . $mes_nascimento . '/' . $ano_nascimento;


		$cpf = $array['cpf'];
		$telefone = $array['telefone'];

		$peso = str_replace('.', ',', $array['peso']);
		$altura = str_replace('.', ',', $array['altura']);

		$tipo_dieta_id = $array['tipo_dieta_id'];

		$modo="?modo=novo";

		//Esse bloco de código só é executado quando o botão SUBMIT for pressionado
		if(isset($_POST['submit'])){

			//Obtendo valor do modo na ação de clique do botão SUBMIT
			$modo = $_GET['modo'];

			//Obtendo os values dos elementos do formulário
			$nome = $_POST['nome'];
			$sobrenome = $_POST['sobrenome'];
			$sexo = $_POST['sexo'];

			$data_nascimento = $_POST['data_nascimento'];

			$dia_nascimento = substr($data_nascimento, 0, 2);
			$mes_nascimento = substr($data_nascimento, 3, 2);
			$ano_nascimento = substr($data_nascimento, 6, 4);

			$data_nascimento = $ano_nascimento . '-' . $mes_nascimento . '-' . $dia_nascimento;

			$cpf = $_POST['cpf'];
			$telefone = $_POST['telefone'];
			
			$peso = str_replace(',', '.', $_POST['peso']);
			$altura = str_replace(',', '.', $_POST['altura']);
			
			$tipo_dieta_id = $_POST['tipo_dieta_id'];

			//upload do arquivo
			$pastaDestino = 'img/usuario/';//diretório
			$nome_foto = basename($_FILES['arquivo']['name']);//nome da imagem
			$caminho_imagem = $pastaDestino.$nome_foto;//caminho que será salvo no banco de dados
			$imagem = $_FILES['arquivo']['tmp_name'];// A imagem propriamente dita (Bitmap)

			//Se for um novo registro...
			if($modo == 'novo') {
				Editar($_SESSION['usuario_id'], $nome, $sobrenome, $sexo, $data_nascimento, $cpf, $telefone, $peso, $altura, $tipo_dieta_id, $imagem, $caminho_imagem);
			//Se der algum problema...
			} else{
				echo 'cago';
			}
		}



	} else {
		header('location:home.php');
	}

 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<link rel="icon" type="image/gif" href="img/logo.png">
	<title>Dados do Usuário - Frozen Fitness Gourmet</title>
	<link href="css/home.css" rel="stylesheet"/>

	<!-- Estilização Desktop -->
	<link href="css/template.css" rel="stylesheet"/>
	<link href="css/dados_usuario.css" rel="stylesheet"/>
	
	<!-- Estilização Mobile -->
	<link href="css/mobile/template.css" rel="stylesheet"/>
	<link href="css/mobile/dados_usuario.css" rel="stylesheet"/>

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>

	<!-- Template de efeitos -->
	<script src="js/template.js"></script>

	<!-- <script src="js/barra_busca.js"></script> -->

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

	<!-- Script da imagem -->
	<script type="text/javascript" src="js/upload_image.js"></script>

	<!-- Mascara -->
	<script type="text/javascript" src="cms/js/jquery_mask.js"></script>

	<style type="text/css" media="screen and (max-width-device:500px)">
		.jFiler-input-dragDrop {
			width: 50%;
		}
	</style>

	<script type="text/javascript">
		$(document).ready(function(){

		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			if ($(window).width() < 500) {
				$('.jFiler-input-dragDrop').css('width', '100%');
			}



			// Máscara
			$('#data_nascimento').mask('00/00/0000');
			$('#cpf').mask('000.000.000-00');
			$('#telefone').mask('(00)0000-00000');

			$('#edit').attr('disabled', 'disabled');
			$('#up_image').css('display', 'none');

			$('#icon_edit').click(function(){

				// $('.dados_usuario').find('h4').css('margin-left', '2%');

				$('input').removeAttr('disabled');
				$('select').removeAttr('disabled');
				$('#icon_edit').css('display', 'none');
				$('#edit').removeAttr('disabled');
				$('#up_image').css('display', 'table-row');
				$('#view_image').css('display', 'none');
			});

			// Mensagem para editar
			$('#icon_edit').mouseover(function(){
				$('.tooltip').css('display', 'inline-block');
			});
			// Caso o mouse não esteja em cima
			$('#icon_edit').mouseout(function(){
				$('.tooltip').css('display', 'none');
			});

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

	<!-- Conteúdo do site -->
	<div class="esp_conteudo">

		<!-- Faça seu conteúdo aqui -->
		<div class="conteudo">

      <div class="dados_usuario">
				<form name="form_dados_usuario" method="post" enctype="multipart/form-data" action="dados_usuario.php<?php echo $modo ?>">
	        <table>
	          <thead>
	            <tr>
	              <th colspan="2">
	                <h4>Informações do Usuário</h4>
	                <span id="icon_edit"></span>
	                <span class="tooltip">Editar</span>
	              </th>
	            </tr>
	          </thead>
	          <tbody>
	            <tr>
	              <td>Nome: </td>
	                <td><input type="text" name="nome" value="<?php echo $nome ?>" disabled></td>
	            </tr>
	            <tr>
	              <td>Sobrenome: </td>
	              <td><input type="text" name="sobrenome" value="<?php echo $sobrenome ?>" disabled></td>
	            </tr>
	            <tr>
	              <td>Sexo: </td>
	              <td>
	              	<select name="sexo" disabled>
	              		<?php 

	              		$conexao = connect();
	              		$sql = "select * from usuario where usuario_id =" .$_SESSION['usuario_id'];
	              		$query = mysqli_query($conexao, $sql);
	              		mysqli_close($conexao);
	              		$array = mysqli_fetch_array($query);
	              		$sexo = $array["sexo"];


	              		if ($sexo == 1) {
	              			$txt_sexo = "Masculino";
	              			$sexo_inv = 0;
	              			$txt_sexo_inv = "Feminino";
	              		?>
	              		<?php
	              		} else {
	              			$txt_sexo = "Feminino";
	              			$sexo_inv = 1;
	              			$txt_sexo_inv = "Masculino";
	              		?>
	              		<?php
	              		}

	              		 ?>
	              		<option value="<?php echo $sexo ?>"><?php echo $txt_sexo ?></option>
	              		<option value="<?php echo $sexo_inv ?>"><?php echo $txt_sexo_inv ?></option>
	              		
	              	</select>

	              </td>
	            </tr>
	            <tr>
	              <td>Data de Nascimento: </td>
	              <td><input type="text" id="data_nascimento" name="data_nascimento" value="<?php echo $data_nascimento ?>" disabled></td>
	            </tr>
	            <tr>
	              <td>CPF: </td>
	              <td><input type="text" id="cpf" name="cpf" value="<?php echo $cpf ?>" disabled></td>
	            </tr>
	            <tr>
	              <td>Telefone: </td>
	              <td><input type="text" if="telefone" name="telefone" value="<?php echo $telefone ?>" disabled></td>
	            </tr>
	            <tr>
	              <td>Peso: </td>
	              <td><input type="text" name="peso" value="<?php echo $peso ?>" disabled></td>
	            </tr>
	            <tr>
	              <td>Altura: </td>
	              <td><input type="text" name="altura" value="<?php echo $altura ?>" disabled></td>
	            </tr>
	            <tr>
	              <td>Tipo de Dieta: </td>
	              <td>
	              	<select name="tipo_dieta_id" disabled>
	              		<?php 
		              		$conexao = connect();
		              		$sql = "select * from tipo_dieta where tipo_dieta_id =".$tipo_dieta_id;
		              		$query = mysqli_query($conexao, $sql);
		              		$array = mysqli_fetch_array($query);
		              		$tipo_dieta = $array["nome"];
	              		?>
	              		<option value="<?php echo $tipo_dieta_id ?>"><?php echo $tipo_dieta ?></option>
	              		<?php
	              			$conexao = connect();
		              		$sql = "select * from tipo_dieta where tipo_dieta_id <> ".$tipo_dieta_id;
		              		$query = mysqli_query($conexao, $sql);
		              		while($array = mysqli_fetch_array($query)) {
	              		?>
	              		<option value="<?php echo $array['tipo_dieta_id'] ?>"><?php echo $array["nome"] ?></option>
	              		<?php } ?>

	              	</select>
	              </td>
	            </tr>
				<?php if (!empty($_SESSION['imagem'])) { ?>
				<tr id="view_image">
	              <td>Imagem Atual: </td>
	              <td><img src="<?php echo $_SESSION['imagem'] ?>" alt="<?php echo $_SESSION['imagem'] ?>" ></td>
	            </tr>
				<?php } ?>
	            <tr id="up_image">
	              <td>Imagem: </td>
	              <td><input name="arquivo" type="file" id="filer_input" multiple="multiple" data-jfiler-limit="1"/></td>
	            </tr>
	            <tr>
	              <td></td>
	              <td><input type="submit" name="submit" value="Editar" id="edit"></td>
	            </tr>
	          </tbody>
	        </table>
	      </form>
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
