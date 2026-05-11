<?php

  require_once('php/crud_carrinho.php');

  // Verificando se a sessão já foi aberta
  if(!isset($_SESSION)) {
      session_start();
  }

  if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
  }

  if (isset($_SESSION['processo_compra'])) {
    if ($_SESSION['processo_compra'] == 1) {
      header("location:dados_entrega.php");
    } else if ($_SESSION['processo_compra'] == 2) {
      header("location:pagamento.php");
    }
  } else {
    $_SESSION['processo_compra'] = 0;
  }

  

  /* Contagem do carrinho */
  $contagem_prato = 0;
  $contagem_dieta = 0;
  $contagem_carrinho = 0;

  if (!empty($_SESSION['carrinho']['prato'])) {
    $contagem_prato = count($_SESSION['carrinho']['prato']);
  }
  if (!empty($_SESSION['carrinho']['dieta'])) {
    $contagem_dieta = count($_SESSION['carrinho']['dieta']);
  }

  $contagem_carrinho = $contagem_prato + $contagem_dieta;

  if($contagem_carrinho == 0) {
    if(isset($_SESSION['carrinho']['prato'])) {
      unset($_SESSION['carrinho']['prato']);
    }
    if(isset($_SESSION['carrinho']['dieta'])) {
     unset($_SESSION['carrinho']['dieta']); 
    }
  }

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

  // print_r($_SESSION['carrinho']);



 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Carrinho de Compras</title>
    <link rel="icon" type="image/gif" href="img/logo.png">
    <link href="css/home.css" rel="stylesheet"/>

    <!-- Estilização Desktop -->
    <link href="css/template.css" rel="stylesheet"/>
    <link href="css/carrinho.css" rel="stylesheet"/>

    <!-- Estilização Mobile -->
    <link href="css/mobile/template.css" rel="stylesheet"/>
    <link href="css/mobile/carrinho.css" rel="stylesheet"/>

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Template de Efeitos -->
    <script src="js/template.js"></script>

    <!-- JavaScript 2.1 -->
    <script type="text/javascript" src="js/jquery-2.1.3.js"></script>

    <!-- jQuery do tipo data -->
    <link rel="stylesheet" href="js/jquery-ui/jquery-ui.css">
    <script src="js/jquery-ui/jquery-ui.js"></script>

    <!-- Estilização -->
    <link rel="stylesheet" type="text/css" href="css/template.css">
    <link rel="stylesheet" type="text/css" href="css/banner.css">

    <script type="text/javascript" src="js/carrinho.js"></script>

    <!-- Numeral JS -->
    <script type="text/javascript" src="js/numeral_js/numeral.js"></script>

    <!-- Máscara -->
    <script type="text/javascript" src="cms/js/jquery_mask.js"></script>

    <style media="screen">
      .box_dieta {
        margin: 0;
      }

      td {
        width: 25%;
      }
    </style>

    <script type="text/javascript">

      $(document).ready(function(){

        $(".input_number").mask("00");


        if ($(window).width() < 500) {
          // $("table").find("td:nth-child(2):first, th:nth-child(2)").css('background-color', 'red');
          // $("table").find("th:nth-child(2)").html(txt);
          
          
          var textArray = new Array(0);

          $(".tr_produto").find(".td_nome").each(function() {
              textArray.push($(this).text());
          });

          // Contador
          var i = 0
          $(".tr_produto").find("td:first").each(function(){
            $(this).append("<p>"+textArray[i]+"</p>");
            i++;
          });

          // var txt = $(".tr_produto").find(".td_nome:first").text();
          // $(".tr_produto").find("td:first").append("<p>"+txt+"</p>");

          $("table").find("td:nth-child(2)").add("th:nth-child(2)").not("#except_limpar").remove();
          $(".last_line").find("td:first").remove();

          // Renomendo as tabelas
          $("table").find("th:nth-child(2)").text("QTDE");
          $("table").find("th:nth-child(4)").text("SUB");
          $("table").find("th:last").text("");
          $("table").find("td:last").attr("colspan", "4");

          $(".tr_menor").find("td:first").remove();
          $(".tr_menor").find("td:last").attr("colspan","2");

          // $(".cx_produto").css("width", "30px");



          // $("table").find("td:nth-child(3)").add("td:nth-child(4)").css({"position":"absolute", "margin":"15% 0"});
          // $("table").find("td:nth-child(3)").css("left","51%");
          // $("table").find("td:nth-child(4)").css("left","71%");

          // $(".tr_menor").find("td").removeAttr("style");

          // $("table").find()
        }
      });

      /*window.onbeforeunload = function (e) {
        return "Tem certeza de que deseja sair?\nTenha certeza de que você salvou ou imprimiu a página!";
      };*/

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

        <!-- Produtos adicionados -->
        <?php
          Listar();
        ?>

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
