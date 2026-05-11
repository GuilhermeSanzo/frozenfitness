<?php

  // Fazendo a conexão no arquivo geral
  require_once('../cms/php/geral.php');

  // Verifica se a sessão foi iniciada
  if(!isset($_SESSION)) {
      session_start();
  }

  // Inserindo os dados
  if(isset($_POST['inserir'])) {

    $conexao = connect();

    $logradouro = $_POST['logradouro'];
    $nome = $_POST['nome'];
    $numero = $_POST['numero'];
    $cep = $_POST['cep'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $data_entrega = $_POST['data_entrega'];

    // Pegando o ultimo pedido feito
    $sql_pedido = "select * from pedido order by pedido_id desc limit 1";
    $select_pedido = mysqli_query($conexao, $sql_pedido);
    $array_pedido = mysqli_fetch_array($select_pedido);
    $pedido_id = $array_pedido['pedido_id'];

    $sql_data_pedido = "update pedido set dt_entrega_solic = '".$data_entrega."', data_pedido = CURDATE() where pedido_id =" .$pedido_id;
    mysqli_query($conexao, $sql_data_pedido);


    // Inserindo na tabela de endereço
    $sql_insert = "insert into endereco(logradouro, nome, numero, cep, bairro, cidade, estado, tipo_endereco_id)
    values ('".$logradouro."', '".$nome."', ".$numero.", '".$cep."', '".$bairro."', '".$cidade."', '".$estado."', 2)";
    mysqli_query($conexao, $sql_insert);

    // Pegando os dados do ultimo pedido inserido
    $sql_endereco = "select endereco_id from endereco order by endereco_id desc limit 1;";
    $select_endereco = mysqli_query($conexao, $sql_endereco);
    $array_endereco = mysqli_fetch_array($select_endereco);
    $endereco_id = $array_endereco['endereco_id'];

    // Atualizando o endereço do funcionário
    $sql_update = "update usuario set endereco_id = ".$endereco_id." where usuario_id =".$_SESSION['usuario_id'];
    mysqli_query($conexao, $sql_update);

    mysqli_close($conexao);

    // Redirecionando a página
    header('location:../pagamento.php');

  }


  // Atualizando os dados
  if(isset($_POST['atualizar'])) {
    $conexao = connect();

    $logradouro = $_POST['logradouro'];
    $nome = $_POST['nome'];
    $numero = $_POST['numero'];
    $cep = $_POST['cep'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $data_entrega = $_POST['data_entrega'];

    $dia_entrega = substr($data_entrega, 0, 2);
    $mes_entrega = substr($data_entrega, 3, 2);
    $ano_entrega = substr($data_entrega, 6, 4);

    $data_entrega = $ano_entrega.'-'.$mes_entrega.'-'.$dia_entrega;

    // Pegando o ultimo pedido feito
    $sql_pedido = "select * from pedido order by pedido_id desc limit 1";
    $select_pedido = mysqli_query($conexao, $sql_pedido);
    $array_pedido = mysqli_fetch_array($select_pedido);
    $pedido_id = $array_pedido['pedido_id'];

    $sql_data_pedido = "update pedido set dt_entrega_solic = '".$data_entrega."', data_pedido = CURDATE() where pedido_id =" .$pedido_id;
    mysqli_query($conexao, $sql_data_pedido);

    // Pegando os dados do ultimo pedido inserido
    //$sql_usuario = "select endereco_id from usuario order by usuario_id desc limit 1;";
    $sql_usuario = "select endereco_id from usuario where usuario_id =" . $_SESSION['usuario_id'];
    $select_usuario = mysqli_query($conexao, $sql_usuario);
    $array_usuario = mysqli_fetch_array($select_usuario);
    $endereco_id = $array_usuario['endereco_id'];

    // Atualizando o endereço do funcionário
    $sql_update = "update endereco set logradouro = '".$logradouro."', nome = '".$nome."', numero = ".$numero.", cep = '".$cep."', bairro = '".$bairro."', cidade = '".$cidade."', estado = '".$estado."'
    where endereco_id = ".$endereco_id;
    mysqli_query($conexao, $sql_update);

    mysqli_close($conexao);

    // Redirecionando a página
    header('location:../pagamento.php?asdasfgdfdjkfh='.$endereco_id);
  }

?>
