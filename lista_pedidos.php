<?php
  
  require_once('php/crud_lista_pedidos.php');

  // Verificando se a sessão já foi aberta
  if(!isset($_SESSION)) {
      session_start();
  }

  if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
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

  // Deixando o popup de mais detalhes desativado
  $ativado = "desativado";

  if(isset($_GET['modo'])){

    //obtendo valor do modo no CARREGAMENTO DA PAGINA
    $modo = $_GET['modo'];

    if($modo == 'detalhe') {
      $_SESSION['pedido_id'] = $_GET['pedido_id'];
      // Ativando o popup de mais detalhes;
      $ativado = "ativado";
    }

  }

  // print_r($_SESSION['carrinho']);



 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>Lista de Pedidos</title>
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

    <script type="text/javascript">
      $(document).ready(function(){
        $('tr').on('mouseover',function() {
          $('selector').css('cursor','pointer');
        })
        $(".tbl_lista_carrinho").find('tr').on("click", function() {
            document.location = $(this).attr('data_href');
        });
        $(".link_lista_pedidos").removeAttr("href");
      });

      // Fechando o quadro de detalhes pelo botão
      $(document).ready(function(){
        var container = $(".popup");

        $(".popup_close").click(function(){
          container.hide();
          window.location.href = "lista_pedidos.php";
        });

      });


    </script>

    <style type="text/css">
      tr {
        cursor: pointer;
      }

      table {
      border-collapse: collapse;
    }

    @media only screen and (max-width: 500px) {
      .popup {
        width: 90%;
        height: 90%;
        background-color: #fff;
        margin: auto;
        z-index: 100;
        position: fixed;
        top: 50%;
        left: 5%;
        transform: translateY(-50%);
        border: 1px solid #000;
        box-shadow: 0 0 200px #000;
        display: none;
      }

      .popup table tr .popup_titulo {
        width: 36%;
        text-align: right;
        font-weight: bold;
        position: relative;
        right: 2%;
      }

      .input_resultado {
        width: 88%;
        height: 40px;
        border: 1px solid #000;
        border-radius: 50px;
        font-size: 16px;
        text-align: center;
        padding: 0 4%;
        outline: none;
        background: #fff;
      }

      .popup h2 {
        text-align: center;
        margin-top: 2%;
        color: #70d06f;
        margin-left: 10%;
      }

    }

    @media only screen and (min-width: 500px) {
      .popup {
        width: 1200px;
        height: 90%;
        background-color: #fff;
        margin: auto;
        z-index: 100;
        position: fixed;
        top: 50%;
        transform: translateY(-50%);
        border: 1px solid #000;
        box-shadow: 0 0 200px #000;
        display: none;
      }

      .popup table tr .popup_titulo {
        width: 40%;
        text-align: right;
        font-weight: bold;
        position: relative;
        left: -50px;
      }

      .input_resultado {
        width: 69%;
        height: 40px;
        border: 1px solid #000;
        border-radius: 50px;
        font-size: 16px;
        text-align: center;
        padding: 0 4%;
        outline: none;
        background: #fff;
      }

      .popup h2 {
        text-align: center;
        margin-top: 2%;
        color: #70d06f;
      }
      
    }


    .popup_close {
      width: 50px;
      height: 50px;
      background: url('cms/img/close-circle.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
      display: block;
      float: right;
      cursor: pointer;
      border-radius: 50%;
    }

    .detail {
      width: 50px;
      height: 50px;
      background: url('cms/img/detail.png');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      display: inline-block;
    }

    .remove {
      width: 50px;
      height: 50px;
      background: url('cms/img/remove.png');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      display: inline-block;
    }

    .ativado {
      display: block;
    }

    .desativado {
      display: none;
    }

    .popup table {
      border-collapse: collapse;
      width: 96%;
      margin: auto;
      margin-top: 2%;
    }

    .popup table tr {
    }

    .popup table tr td {
      padding-bottom: 10px;
    }

    

    .popup table tr .popup_resultado {
      width: 60%;
      text-align: justify;
    }

    .textarea_resultado {
      width: 69%;
      height: 200px;
      border: 1px solid #000;
      border-radius: 20px;
      font-size: 16px;
      text-align: center;
      padding: 0 4%;
      outline: none;
      background: #fff;
      resize: none;
    }

    .textarea_resultado::-webkit-scrollbar {
      display: none;
    }

    .popup_excluir_link {
      text-align: center;
      text-decoration: none;
      color: #fff;
    }

    .popup_excluir {
      width: 60%;
      height: 40px;
      border: 1px solid #000;
      border-radius: 20px;
      font-size: 16px;
      text-align: center;
      padding: 0 4%;
      outline: none;
      background: #fb5555;
      resize: none;

    }

    .popup_excluir p {
      position: relative;
      top: 50%;
      transform: translateY(-50%);
    }

    .lido {
      background-color: #ffffff;
      font-weight: normal;
    }

    .nao_lido {
      background: #dedede;
        font-weight: bold;
    }
    </style>

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

        <!-- Popup de mais detalhes -->
        <div class="popup <?php echo($ativado) ?>">
          <span class="popup_close"></span>
          <table>
            <h2>Informações Detalhadas</h2>
            <?php
              ListarDetalhado($_SESSION['pedido_id']);
            ?>
          </table>
        </div>


        <a class="link_lista_pedidos" href="lista_pedidos.php">
          <h2>Lista de Pedidos</h2>
        </a>
        <?php
          if (!empty($_SESSION['usuario_id'])) {
            Listar();
          }
          else {
        ?>
        <div class="lista_carrinho">
          <h1 class="titulo_sem_produto">Não há pedidos na lista!</h1>
          <span class="sad_face"></span>
        </div>
        <?php
          }
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
