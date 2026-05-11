<?php

  require_once('php/crud_dados_entrega.php');

  // Verificando se a sessão já foi aberta
  if(!isset($_SESSION)) {
    session_start();
  }

  if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
  }

  // Verificando se o carrinho está vazio, para o usuário não burlar o sistema
  if (empty($_SESSION['carrinho'])) {
    echo"<script>alert('Você não realizou nenhuma compra!')</script>";
    header("Refresh:0; url=carrinho.php");
  }

  // Verificando se o usuário já passou pelo carrinho
  if (isset($_SESSION['processo_compra'])) {
    if ($_SESSION['processo_compra'] == 0) {
      header("location:carrinho.php");
    } else if ($_SESSION['processo_compra'] == 2) {
      header("location:pagamento.php");
    }
  } else {
    $_SESSION['processo_compra'] = 0;
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
<html>
  <head>
    <meta charset="utf-8"/>
   	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
   	<title>Carrinho de Compras</title>
   	<link rel="icon" type="image/gif" href="img/logo.png">
    
    <!-- Estilização Desktop -->
    <link href="css/template.css" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet"/>
    <link href="css/carrinho.css" rel="stylesheet"/>
    <link href="css/dados_entrega.css" rel="stylesheet">

    <!-- Estilização Mobile -->
    <link href="css/mobile/template.css" rel="stylesheet">
    <link href="css/mobile/home.css" rel="stylesheet"/>
    <link href="css/mobile/carrinho.css" rel="stylesheet"/>
    <link href="css/mobile/dados_entrega.css" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Template de Efeitos -->
    <script src="js/template.js"></script>

    
   	<!-- JavaScript 2.1 -->
   	<script type="text/javascript" src="js/jquery-2.1.3.js"></script>

   	<!-- jQuery do tipo data -->
   	<link rel="stylesheet" href="js/jquery-ui/jquery-ui.css">
   	<script src="js/jquery-ui/jquery-ui.js"></script>

    <script type="text/javascript" src="js/carrinho.js"></script>
    <script type="text/javascript" src="js/jquery_mask.js"></script>
    <script type="text/javascript" src="js/dados_entrega.js"></script>

    <script type="text/javascript" src="js/numeral_js/numeral.js"></script>

    <!-- Máscara -->
    <script type="text/javascript" src="cms/js/jquery_mask.js"></script>

    <script type="text/javascript">
      jQuery(function($){
        $("#data_entrega").mask("00/00/0000");

        var data_minima, data_maxima;


        var today_min = new Date();
        var dd_min = today_min.getDate() + 3;
        var mm_min = today_min.getMonth() + 1; //January is 0!
        var yyyy_min = today_min.getFullYear();

        // Se a data for menor do que 9
        if (dd_min <= 9) {
          dd_min = "" + 0 + dd_min;
        }

        // Se o mês for menor do que 9
        if (mm_min <= 9) {
          mm_min = "" + 0 + mm_min;
        }

        data_minima = (yyyy_min + "" + mm_min + "" + dd_min ) * 1;

        var today_max = new Date();
        var dd_max = today_max.getDate() + 3;
        var mm_max = today_max.getMonth() + 1; //January is 0!
        var yyyy_max = today_max.getFullYear() + 1;

        // Se a data for menor do que 9
        if (dd_max <= 9) {
          dd_max = "" + 0 + dd_max;
        }

        // Se o mês for menor do que 9
        if (mm_max <= 9) {
          mm_max = "" + 0 + mm_max;
        }

        data_maxima = (yyyy_max + "" + mm_max + "" + dd_max ) * 1;

        $("#data_entrega").on("keyup",function(){
          
          var data_entrega = $("#data_entrega").val();

          var dia_entrega = data_entrega.substr(0, 2);
          var mes_entrega = data_entrega.substr(3, 2);
          var ano_entrega = data_entrega.substr(6, 4);

          data_entrega = (ano_entrega +"" +mes_entrega +"" + dia_entrega ) *1;


          // Se a data de entrega for menor do que o requerido...
          if (data_entrega < data_minima || data_entrega > data_maxima) {
            $('.tooltip').css('display', 'block');
            $('.tooltip_valid').css('display', 'none');
            $("#submit").attr('disabled','disabled');
          // Caso seja maior...
          } else {
            $('.tooltip').css('display', 'none');
            $('.tooltip_valid').css('display', 'block');
            $("#submit").removeAttr('disabled');
          }

          // Verificando se é uma data válida
          if (dia_entrega > 31 || mes_entrega > 12) {
            $('.tooltip').css('display', 'block');
            $('.tooltip_valid').css('display', 'none');
            $("#submit").attr('disabled','disabled');
          }

          if (dia_entrega > 28 && mes_entrega == 2) {
            $('.tooltip').css('display', 'block');
            $('.tooltip_valid').css('display', 'none');
            $("#submit").attr('disabled','disabled'); 
          }

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

      <div class="conteudo">
        <a class="link_lista_pedidos" href="lista_pedidos.php">
          <h2>Lista de Pedidos</h2>
        </a>
        <!-- Andamento da compra -->
        <div class="box_processo_compras">
          <!-- <a href="carrinho.php"> -->
          <a href="javascript: void(0)">
            <div class="box_processo_compra cart">
              <p>Carrinho</p>
            </div>
          </a>
          <div class="seta_direita"></div>
          <!-- <a href="dados_entrega.php"> -->
          <a href="javascript: void(0)">
            <div class="box_processo_compra delivery">
              <p>
                Dados de Entrega
              </p>
            </div>
          </a>
          <div class="seta_direita"></div>
          <!-- <a href="pagamento.php"> -->
          <a href="javascript: void(0)">
            <div class="box_processo_compra payment">
              <p>
                Pagamento
              </p>
            </div>
          </a>
        </div>

        <!-- Cadastro ou verificação de endereço -->

        <div class="endereco">

          <?php

            // Verificando se o usuário está logado
            if (!empty($_SESSION['usuario_id'])) {
              $conexao = connect();

              $sql = "select e.endereco_id as 'endereco' from usuario as u
              inner join endereco as e on (u.endereco_id = e.endereco_id)
              where usuario_id =". $_SESSION['usuario_id'];
              $query = mysqli_query($conexao, $sql);
              $array = mysqli_fetch_array($query);
              $endereco_id = $array['endereco'];

              mysqli_close($conexao);

              // Verificando se o usuário tem endereço
              if (empty($endereco_id)) {
                Listar();
              } else {
                ListarEspecifico($_SESSION['usuario_id']);
              }
            }

          ?>

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
   	<div style="clear:both"></div>

</body>
</html>
