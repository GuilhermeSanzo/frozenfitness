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

?>

<!DOCTYPE html>
<html>
<head>
	<title>Template do CMS</title>
	<link rel="stylesheet" type="text/css" href="css/template.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="icon" type="image/gif" href="img/logo.png">
	<meta charset="utf-8">
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
				<!-- Seção -->
				<div class="box_secao">
					<a href="cadastro_dieta.php">
						<div class="box_secao_primaria">
							<img src="img/dieta_icon.png" alt="imagem">
							<h3>Dieta</h3>
						</div>
						<div class="box_secao_secundaria">
							<ul>
								<li>Visualizar</li>
								<li>Inserir</li>
								<li>Editar </li>
								<li>Excluir</li>
							</ul>
						</div>
					</a>
				</div>

				<!-- Seção -->
				<div class="box_secao">
					<a href="cadastro_prato.php">
						<div class="box_secao_primaria">
							<img src="img/plate.png" alt="imagem">
							<h3>Prato</h3>
						</div>
						<div class="box_secao_secundaria">
							<ul>
								<li>Visualizar</li>
								<li>Inserir</li>
								<li>Editar </li>
								<li>Excluir</li>
							</ul>
						</div>
					</a>
				</div>

				<!-- Seção -->
				<div class="box_secao">
					<a href="visualizacao_aprovacoes.php">
						<div class="box_secao_primaria">
							<img src="img/plate.png" alt="imagem">
							<h3>Aprovações</h3>
						</div>
						<div class="box_secao_secundaria">
							<ul>
								<li>Visualizar</li>
							</ul>
						</div>
					</a>
				</div>

				<!-- Seção -->
				<div class="box_secao">
					<a href="cadastro_ingrediente.php">
						<div class="box_secao_primaria">
							<img src="img/ingrediente.png" alt="imagem">
							<h3>Ingrediente</h3>
						</div>
						<div class="box_secao_secundaria">
							<ul>
								<li>Visualizar</li>
								<li>Inserir</li>
								<li>Editar </li>
								<li>Excluir</li>
							</ul>
						</div>
					</a>
				</div>


				<!-- Seção -->
				<div class="box_secao">
					<a href="cadastro_tipo_ingrediente.php">
						<div class="box_secao_primaria">
							<img src="img/tipo_ingrediente_icon.png" alt="imagem">
							<h3>Tipo de Ingrediente</h3>
						</div>
						<div class="box_secao_secundaria">
							<ul>
								<li>Visualizar</li>
								<li>Inserir</li>
								<li>Editar </li>
								<li>Excluir</li>
							</ul>
						</div>
					</a>
				</div>
				<!-- Seção -->
				<div class="box_secao">
					<a href="cadastro_tipo_dieta.php">
						<div class="box_secao_primaria">
							<img src="img/tipo_dieta_icon.png" alt="imagem">
							<h3>Tipo de Dieta</h3>
						</div>
						<div class="box_secao_secundaria">
							<ul>
								<li>Visualizar</li>
								<li>Inserir</li>
								<li>Editar </li>
								<li>Excluir</li>
							</ul>
						</div>
					</a>
				</div>
				
				<!-- Seção -->
				<div class="box_secao">
					<a href="cadastro_horario_do_dia.php">
						<div class="box_secao_primaria">
							<img src="img/horario_refeicao_icon.png" alt="imagem">
							<h3>Horário do Dia</h3>
						</div>
						<div class="box_secao_secundaria">
							<ul>
								<li>Visualizar</li>
								<li>Inserir</li>
								<li>Editar </li>
								<li>Excluir</li>
							</ul>
						</div>
					</a>
				</div>
				<!-- Seção -->
				<div class="box_secao">
					<a href="cadastro_fornecedor.php">
						<div class="box_secao_primaria">
							<img src="img/fornecedor.png" alt="imagem">
							<h3>Fornecedor</h3>
						</div>
						<div class="box_secao_secundaria">
							<ul>
								<li>Visualizar</li>
								<li>Inserir</li>
								<li>Editar </li>
								<li>Excluir</li>
							</ul>
						</div>
					</a>
				</div>

				<!-- Seção -->
				<div class="box_secao">
					<a href="cadastro_rel_ingrediente_fornecedor.php">
						<div class="box_secao_primaria">
							<img src="img/rel_ingrediente_parceiro.png" alt="imagem">
							<h3>Relacionamento de Ingrediente e Fornecedor</h3>
						</div>
						<div class="box_secao_secundaria">
							<ul>
								<li>Visualizar</li>
								<li>Inserir</li>
								<li>Editar </li>
								<li>Excluir</li>
							</ul>
						</div>
					</a>
				</div>

				<!-- Seção -->
				<div class="box_secao">
					<a href="cadastro_rel_prato_promocao.php">
						<div class="box_secao_primaria">
							<img src="img/rel_ingrediente_parceiro.png" alt="imagem">
							<h3>Relacionamento de Prato e Promoção</h3>
						</div>
						<div class="box_secao_secundaria">
							<ul>
								<li>Visualizar</li>
								<li style="display:none">Inserir</li>
								<li>Editar </li>
								<li>Excluir</li>
							</ul>
						</div>
					</a>
				</div>

				<!-- Seção -->
				<div class="box_secao">
					<a href="cadastro_aprovacao.php">
						<div class="box_secao_primaria">
							<img src="img/tipo_ingrediente_icon.png" alt="imagem">
							<h3>Status de Aprovação para Pratos e Dietas</h3>
						</div>
						<div class="box_secao_secundaria">
							<ul>
								<li>Visualizar</li>
								<li>Inserir</li>
								<li>Editar </li>
								<li>Excluir</li>
							</ul>
						</div>
					</a>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<!-- Rodapé -->
		<div class="rodape">
			<div class="centralizando_rodape"></div>
		</div>
	</div>

</body>
</html>
