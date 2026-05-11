<?php

  require_once('cms/php/geral.php');

  // Função para listar
  function Listar() {

    $conexao = connect();

    $sql = "select p.*, s.nome as 'status' from pedido as p
    inner join status as s on(p.status_id = s.status_id)
    where cliente_id = ".$_SESSION['usuario_id']."
    order by p.pedido_id desc
    ";
    $query = mysqli_query($conexao, $sql);

    echo "
    <div class='lista_pedido'>
      <table class='tbl_lista_carrinho'>
    ";
    while($array = mysqli_fetch_array($query)) {
      $pedido_id = $array['pedido_id'];

      $data_pedido = $array['data_pedido'];
      $dia_pedido = substr($data_pedido, 8, 2);
      $mes_pedido = substr($data_pedido, 5, 2);
      $ano_pedido = substr($data_pedido, 0, 4);
      $data_pedido = $dia_pedido.'/'.$mes_pedido.'/'.$ano_pedido;

      $data_entrega = $array['dt_entrega_solic'];
      $dia_entrega = substr($data_entrega, 8, 2);
      $mes_entrega = substr($data_entrega, 5, 2);
      $ano_entrega = substr($data_entrega, 0, 4);
      $data_entrega = $dia_entrega.'/'.$mes_entrega.'/'.$ano_entrega;
      
      $status = $array['status'];


      echo "
        <tr data_href='lista_pedidos.php?modo=detalhe&pedido_id=".$pedido_id."'>
            <td>Pedido Nº: ".$pedido_id."</td>
            <td>Data do Pedido: ".$data_pedido."</td>
            <td>Data de Entrega: ".$data_entrega."</td>
            <td>Status: ".$status."</td>
        </tr>
      ";
    }

    echo "
      </table>
    </div>
    ";
    
    mysqli_close($conexao);

    }

    // Listar Detalhado
    function ListarDetalhado($id) {
      $conexao = connect();

      $sql = "select p.pedido_id, p.total_pedido, p.data_pedido, p.dt_entrega_solic,
      s.nome as 'status', 
      pp.*, pr.nome as 'prato'
      from pedido as p
      inner join status as s on(p.status_id = s.status_id)
      inner join rel_prato_pedido as pp on (p.pedido_id = pp.pedido_id)
      inner join prato as pr on (pp.prato_id = pr.prato_id)
      where p.pedido_id = ". $id ."
      group by pp.rel_prato_pedido_id";
      $query = mysqli_query($conexao, $sql);
      $array = mysqli_fetch_array($query);

      mysqli_close($conexao);

      $pedido_id = $array['pedido_id'];

      $data_pedido = $array['data_pedido'];
      $dia_pedido = substr($data_pedido, 8, 2);
      $mes_pedido = substr($data_pedido, 5, 2);
      $ano_pedido = substr($data_pedido, 0, 4);
      $data_pedido = $dia_pedido.'/'.$mes_pedido.'/'.$ano_pedido;

      $data_entrega = $array['dt_entrega_solic'];
      $dia_entrega = substr($data_entrega, 8, 2);
      $mes_entrega = substr($data_entrega, 5, 2);
      $ano_entrega = substr($data_entrega, 0, 4);
      $data_entrega = $dia_entrega.'/'.$mes_entrega.'/'.$ano_entrega;
      
      $status = $array['status'];

      $total_pedido = str_replace('.', ',', $array['total_pedido']);

      $prato_id = $array['prato_id'];
      $prato = $array['prato'];

      echo "
      <tr>
        <td class='popup_titulo'>Nº do Pedido: </td>
        <td class='popup_resultado'><input class='input_resultado' type='text' value='".$pedido_id."' disabled></td>
      </tr>
      <tr>
        <td class='popup_titulo'>Data do Pedido: </td>
        <td class='popup_resultado'><input class='input_resultado' type='text' value='".$data_pedido."' disabled></td>
      </tr>
      <tr>
        <td class='popup_titulo'>Data de Entrega: </td>
        <td class='popup_resultado'><input class='input_resultado' type='text' value='".$data_entrega."' disabled></td>
      </tr>
      <tr>
        <td class='popup_titulo'>Valor Total: </td>
        <td class='popup_resultado'><input class='input_resultado' type='text' value='R$ ".$total_pedido."' disabled></td>
      </tr>
      <tr>
        <td class='popup_titulo'>Status: </td>
        <td class='popup_resultado'><input class='input_resultado' type='text' value='".$status."' disabled></td>
      </tr>
      "
      ;


    }



?>
