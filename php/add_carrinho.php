<?php

  // Fazendo a conexão no arquivo geral
  require_once('../cms/php/geral.php');

  require_once('bootbox_file_links.php');

  // Verifica se a sessão foi iniciada
  if(!isset($_SESSION)) {
      session_start();
  }

  // Verifica se a sessão de array do carrinho já foi iniciada
  if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
  }

  // Adiciona o produto
  if (isset($_GET['action'])) {

    // Adicionando o item no carrinho
    if($_GET['action'] == 'insert') {
  		$prato_id = intval($_GET['prato_id']);
      $dieta_id = intval($_GET['dieta_id']);

      /* Verificando se o cliente está recarregando a página */
      if (!empty($prato_id)) {
        if(!isset($_SESSION['carrinho'][$prato_id])) {
          $_SESSION['carrinho']['prato'][$prato_id] = 1;
        } else {
          $_SESSION['carrinho']['prato'][$prato_id] += 1;
        }
      }

      /* Verificando se o cliente está recarregando a página */
      if (!empty($dieta_id)) {
        if(!isset($_SESSION['carrinho'][$dieta_id])) {
          $_SESSION['carrinho']['dieta'][$dieta_id] = 1;
        } else {
          $_SESSION['carrinho']['dieta'][$dieta_id] += 1;
        }
      }

      if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
      } else {
        header("location:home.php");
      }
    }

    // Removendo o item do carrinho
    if ($_GET['action'] == 'remove') {
      $prato_id = intval($_GET['prato_id']);
      $dieta_id = intval($_GET['dieta_id']);

      // Verificando se o item existe
      if(!empty($prato_id)) {
        if (isset($_SESSION['carrinho']['prato'][$prato_id])) {
          unset($_SESSION['carrinho']['prato'][$prato_id]);
        }
      }

      // Verificando se o item existe
      if(!empty($dieta_id)) {
        if (isset($_SESSION['carrinho']['dieta'][$dieta_id])) {
          unset($_SESSION['carrinho']['dieta'][$dieta_id]);
        }
      }
      header("location:../carrinho.php");
    }

  }

  // Limpando a sessão do carrinho
  if(isset($_POST['limpar'])) {
    unset($_SESSION['carrinho']);
    header("location:../carrinho.php");
  }

  // Finalizando a compra
  if(isset($_POST['finalizar'])) {

    // Atualizando o carrinho
    if (!empty($_POST['produto_prato'])) {
      if (is_array($_POST['produto_prato'])) {
        // Prato
        foreach ($_POST['produto_prato'] as $prato_id => $qtde) {
          $prato_id = intval($prato_id);
          $qtde = intval($qtde);

          if (!empty($qtde) && $qtde > 0) {
            $_SESSION['carrinho']['prato'][$prato_id] = $qtde;
          }
        }
      }
    }

    // Atualizando o carrinho
    if (!empty($_POST['produto_dieta'])) {
      if(is_array($_POST['produto_dieta'])) {
        // Dieta
        foreach ($_POST['produto_dieta'] as $dieta_id => $qtde) {
          $dieta_id = intval($dieta_id);
          $qtde = intval($qtde);

          if (!empty($qtde) && $qtde > 0) {
            $_SESSION['carrinho']['dieta'][$dieta_id] = $qtde;
          }
        }
      }
    }

    //OBTENDO TOTAL DO PEDIDO (SAMUEL QUEM FEZ)

    $nome = null;
    $preco = null;
    $imagem = null;
    $subtotal = null;
    $frete = 10.00;
    $total = null;

    if (!empty($_SESSION['carrinho']['prato'])){
      foreach($_SESSION['carrinho']['prato'] as $prato_id => $qtde){
          $conexao = connect();
          $sql = "select 
                  p.prato_id, 
                  p.nome,
                  p.valor_unitario,
                  p.caminho_imagem,
                  p.descricao,
                  p.tipo_dieta_id,
                  sum(i.kcal_por_100g) as kcal_por_100g, 
                  sum(pi.qtd) as peso, 
                  round((sum(pi.qtd)/100)*sum(i.kcal_por_100g)) as kcal_prato, 
                  count(pp.prato_id) as esta_promocao,
                  round(p.valor_unitario - p.valor_unitario * (pr.porcentagem_desc / 100),2) as valor_desconto,
                  '' as tipo_dieta,
                  '' as qtd_dias,
                          '' as cor,
                  'prato' as tipo
                  from prato as p 
                  inner join rel_prato_ingrediente as pi 
                  on pi.prato_id = p.prato_id 
                  inner join ingrediente as i 
                  on pi.ingrediente_id = i.ingrediente_id 
                  left join rel_prato_promocao as pp
                  on pp.prato_id = p.prato_id
                  left join promocao as pr
                  on pr.promocao_id = pp.promocao_id 
                  where p.prato_id = $prato_id
                  group by p.prato_id 
                  order by kcal_prato";
          $query = mysqli_query($conexao, $sql);
          while($listar = mysqli_fetch_array($query)) {

          $nome = $listar["nome"];
          if($listar['esta_promocao'] > 0){
            $preco = $listar["valor_desconto"];
          }else{
            $preco = $listar["valor_unitario"];
          }
          $imagem = $listar["caminho_imagem"];
          $subtotal = $preco * $qtde;
          $total += $subtotal;

          
        }
      }
    }

    // Dieta ID
    if (!empty($_SESSION['carrinho']['dieta'])){
      foreach($_SESSION['carrinho']['dieta'] as $dieta_id => $qtde){
          $conexao = connect();
          $sql = "select 
                    d.dieta_id,
                    d.nome,
                    sum(p.valor_unitario) as valor_unitario,
                    '' as caminho_imagem,
                    d.descricao,
                    d.tipo_dieta_id,
                    sum(i.kcal_por_100g) as kcal_por_100g,
                    sum(pi.qtd) as peso,
                    (select sum(kcal_dieta) from (select 
                    round((sum(pi.qtd)/100)*sum(i.kcal_por_100g)) as 'kcal_dieta'
                    from dieta as d
                    inner join rel_dieta_prato as dp
                    on (dp.dieta_id = d.dieta_id)
                    inner join prato as p
                    on (dp.prato_id = p.prato_id)
                    inner join rel_prato_ingrediente as pi
                    on (pi.prato_id = p.prato_id)
                    inner join ingrediente as i
                    on (i.ingrediente_id = pi.ingrediente_id)
                    group by p.prato_id) as a) as kcal_dieta,
                    '0' as esta_promocao,
                    NULL as valor_desconto,
                    td.nome as tipo_dieta,
                    count(distinct dp.dia) as qtd_dias,
                            td.cor as cor,
                    'dieta' as tipo
                    from dieta as d
                    inner join rel_dieta_prato as dp
                    on (dp.dieta_id = d.dieta_id)
                    inner join prato as p
                    on (dp.prato_id = p.prato_id)
                    inner join rel_prato_ingrediente as pi
                    on (pi.prato_id = p.prato_id)
                    inner join ingrediente as i
                    on (i.ingrediente_id = pi.ingrediente_id)
                    inner join tipo_dieta as td
                    on (td.tipo_dieta_id = d.tipo_dieta_id) 
                    where d.dieta_id = $dieta_id
                    group by dieta_id";
          $query = mysqli_query($conexao, $sql);
          mysqli_close($conexao);
          while($listar = mysqli_fetch_array($query)) {

          $nome = $listar["nome"];
          $preco = $listar["valor_unitario"];
          $subtotal = $preco * $qtde;
          $total += $subtotal;

        }
      }
    }

    $total = $total + 10.00;
  
    // Verificando se o usuário está logado
    if (!empty($_SESSION['usuario_id'])) {

      // Finalizando o pedido
      $conexao = connect();

      // Inserindo dados na tabela de pedido
      $pedido = "insert into pedido(cliente_id,total_pedido,data_pedido) values (".$_SESSION["usuario_id"].",".$total.",now())";
      mysqli_query($conexao, $pedido);

      // Pegando os dados do ultimo pedido inserido
      $sql_pedido = "select pedido_id from pedido order by pedido_id desc limit 1;";
      $select_pedido = mysqli_query($conexao, $sql_pedido);
      $array_pedido = mysqli_fetch_array($select_pedido);
      $pedido_id = $array_pedido['pedido_id'];

      $pedido_status = "insert into rel_status_pedido (ultima_atualizacao, status_id, pedido_id) values (now(), 1, ".$pedido_id.")";
      $select_pedido = mysqli_query($conexao, $pedido_status);
      // Estrutura de repetição para percorrer o carrinho
      if(!empty($_SESSION['carrinho']['prato'])) {
        foreach ($_SESSION['carrinho']['prato'] as $prato_id => $qtde) {
          $selecao = "select * from prato where prato_id = $prato_id";
          $query = mysqli_query($conexao, $selecao);

          // Inserindo os pratos do pedido
          $prato_pedido = "insert into rel_prato_pedido(prato_id, qtde, pedido_id) values (".$prato_id.", ".$qtde.", ".$pedido_id.")";
          mysqli_query($conexao, $prato_pedido);
        }
      }

      // Estrutura de repetição para percorrer o carrinho
      if(!empty($_SESSION['carrinho']['dieta'])) {
        foreach ($_SESSION['carrinho']['dieta'] as $dieta_id => $qtde) {
          $selecao = "select * from dieta where dieta_id = $dieta_id";
          $query = mysqli_query($conexao, $selecao);

          // Inserindo os pratos do pedido
          $dieta_pedido = "insert into rel_dieta_pedido(dieta_id, qtde, pedido_id) values (".$dieta_id.", ".$qtde.", ".$pedido_id.")";
          mysqli_query($conexao, $dieta_pedido);
        }
      }

      mysqli_close($conexao);

      // Definindo a segunda página como padrão
      $_SESSION['processo_compra'] = 1;

      echo"<script>alert('Pedido feito com sucesso!')</script>";

      header("Refresh:0; url=../dados_entrega.php?aqwioudjaskfh=".$pedido_id);
      // unset($_SESSION['carrinho']);


    // Caso contrário...
    } else {

      echo"
      <script>
        $(document).ready(function(){
          bootbox.alert({
            message: 'Para finalizar a compra, por favor faça o login!',
            callback: function(){
              $(location).attr('href','../login.php');
            }
          });
        });
      </script>";

      echo"<script>alert('Para finalizar a compra, por favor faça o login!')</script>";
      header("Refresh:0; url=../login.php");
    }




  }



 ?>
